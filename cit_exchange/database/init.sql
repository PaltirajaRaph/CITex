-- Create database
CREATE DATABASE IF NOT EXISTS forum_db;
USE forum_db;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create posts table
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    topic VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create comments table
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert a default admin user (password: admin123)
INSERT INTO users (username, password, email) VALUES 
('admin', '$2y$10$8tGhZ.jcqBRBX9TI/PVHNuE0uqCHGRNPhx9yVzOSfN5mV6ERCE40q', 'admin@example.com');

-- Content from ibda_iee_posts.sql
-- Add posts for the International Business Development and Agreements (IBDA) topic
INSERT INTO posts (user_id, title, content, topic) VALUES
(1, 'Understanding International Trade Agreements', 'This post explores the fundamentals of international trade agreements and their impact on global commerce. We will discuss GATT, WTO, and regional trade blocs.', 'IBDA'),
(1, 'Negotiation Strategies for Cross-Border Partnerships', 'Learn effective negotiation techniques specifically tailored for international business partnerships. Cultural considerations and legal frameworks will be covered.', 'IBDA'),
(1, 'Risk Management in International Contracts', 'Exploring methods to identify, assess, and mitigate risks in international business contracts. Topics include force majeure clauses and arbitration provisions.', 'IBDA');

-- Add posts for the International Economic Environment (IEE) topic
INSERT INTO posts (user_id, title, content, topic) VALUES
(1, 'Global Economic Indicators and Their Significance', 'An overview of important economic indicators that businesses should monitor when operating internationally. Includes GDP, inflation rates, and currency stability.', 'IEE'),
(1, 'Impact of Exchange Rate Fluctuations on International Business', 'This post examines how currency exchange rate movements affect international businesses and strategies to hedge against currency risks.', 'IEE'),
(1, 'Emerging Markets: Opportunities and Challenges', 'Analysis of business opportunities in emerging economies, along with associated risks and challenges. Case studies from BRICS nations will be presented.', 'IEE');

-- Content from asd_scce_posts.sql
-- Add posts for the Algorithms and Software Development (ASD) topic
INSERT INTO posts (user_id, title, content, topic) VALUES
(1, 'Introduction to Dynamic Programming', 'This post explores the concept of dynamic programming and its applications in solving complex algorithmic problems. We will cover memoization, tabulation, and example problems.', 'ASD'),
(1, 'Clean Code Practices for Maintainable Software', 'Learn best practices for writing clean, maintainable code that can be easily understood by other developers. Topics include meaningful naming, function design, and code organization.', 'ASD'),
(1, 'Microservices Architecture: Benefits and Challenges', 'An exploration of microservices architecture, its advantages over monolithic applications, and the challenges associated with implementing and managing microservices.', 'ASD');

-- Add posts for the Software Construction and Component Engineering (SCCE) topic
INSERT INTO posts (user_id, title, content, topic) VALUES
(1, 'Design Patterns for Robust Software Systems', 'This post covers essential software design patterns including Singleton, Factory, Observer, and more. Examples and use cases for each pattern are provided.', 'SCCE'),
(1, 'Continuous Integration and Deployment Pipelines', 'A comprehensive guide to setting up CI/CD pipelines for software projects. Tools like Jenkins, GitLab CI, and GitHub Actions will be discussed.', 'SCCE'),
(1, 'Component-Based Software Engineering Principles', 'Learn about developing software using reusable components. This post covers component interfaces, dependency management, and testing strategies.', 'SCCE');

-- Content from bms_cfp_posts.sql
-- Add posts for the Brand Management Strategies (BMS) topic
INSERT INTO posts (user_id, title, content, topic) VALUES
(1, 'Building a Strong Brand Identity', 'This post explores the key elements of brand identity and how to create a cohesive brand experience. Topics include visual identity, brand voice, and positioning.', 'BMS'),
(1, 'Measuring Brand Equity and ROI', 'Learn methods for quantifying brand value and measuring return on investment for branding initiatives. We will discuss brand valuation models and KPIs.', 'BMS'),
(1, 'Digital Brand Management Strategies', 'Best practices for managing your brand in the digital age. This post covers social media branding, online reputation management, and digital brand consistency.', 'BMS');

-- Add posts for the Consumer Financial Protection (CFP) topic
INSERT INTO posts (user_id, title, content, topic) VALUES
(1, 'Understanding Consumer Financial Protection Regulations', 'An overview of key regulations designed to protect consumers in financial markets. Includes discussion of regulatory bodies and compliance requirements.', 'CFP'),
(1, 'Ethical Considerations in Financial Product Design', 'This post examines ethical frameworks for designing financial products that are beneficial and fair to consumers while remaining profitable.', 'CFP'),
(1, 'Data Privacy in Financial Services', 'Exploring the intersection of consumer data protection and financial services. Topics include regulatory requirements, security best practices, and ethical use of customer data.', 'CFP');