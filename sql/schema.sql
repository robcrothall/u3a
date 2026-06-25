-- =============================================
-- Database Schema for LAHS Toposcope Journal
-- =============================================
use lahs;
-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash TEXT NOT NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    is_active TINYINT DEFAULT 1,
    created_at DATETIME DEFAULT NOW(),
    updated_at DATETIME DEFAULT NOW() ON UPDATE NOW()
);

-- Membership Class Table
CREATE TABLE membership_class (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(100) UNIQUE NOT NULL,
    description VARCHAR(500),
    created_at DATETIME DEFAULT NOW(),
    updated_at DATETIME DEFAULT NOW() ON UPDATE CURRENT_TIMESTAMP
);

-- User Membership Class Junction Table
CREATE TABLE user_membership_class (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    membership_class_id INT NOT NULL,
    date_assigned DATETIME DEFAULT NOW(),
    date_expires DATETIME NULL,
    is_active TINYINT DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (membership_class_id) REFERENCES membership_class(id),
    CONSTRAINT UK_user_membership UNIQUE (user_id, membership_class_id)
);

-- Documents Table
CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doc_name VARCHAR(255) UNIQUE NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    description VARCHAR(1000),
    file_size INT,
    created_at DATETIME DEFAULT NOW(),
    updated_at DATETIME DEFAULT NOW() ON UPDATE NOW()
);

-- Document Access Log Table
CREATE TABLE docs_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doc_id INT NOT NULL,
    user_id INT,
    date_read DATETIME DEFAULT NOW(),
    ip_address VARCHAR(50),
    user_agent TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_date_read (date_read),
    INDEX idx_user_id (user_id),
    INDEX idx_doc_id (doc_id)
);

-- =============================================
-- Indexes
-- =============================================

CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_username ON users(username);
CREATE INDEX idx_membership_class_name ON membership_class(class_name);
CREATE INDEX idx_user_membership_active ON user_membership_class(user_id, is_active);
CREATE INDEX idx_documents_name ON documents(doc_name);
