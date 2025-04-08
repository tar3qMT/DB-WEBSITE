-- Users Table: stores personal information
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    date_joined TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Income Table: track income sources for financial analysis
CREATE TABLE Income (
    income_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    income_source VARCHAR(100) NOT NULL,
    income_amount DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Categories Table: group categories into food, electric, transportation etc
CREATE TABLE Categories (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(100) NOT NULL
);

-- SavingsGoals Table: tracks user's saving goals
CREATE TABLE SavingsGoals (
    goal_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    goal_name VARCHAR(100) NOT NULL,
    target_amount DECIMAL(10, 2) NOT NULL,
    current_amount DECIMAL(10, 2) DEFAULT 0,
    category_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (category_id) REFERENCES Categories(category_id)
);

-- Transactions Table: tracks user's spending activity
CREATE TABLE Transactions (
    transaction_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    transaction_amount DECIMAL(10, 2) NOT NULL,
    category_id INT,
    transaction_date DATE NOT NULL,
    transaction_location VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (category_id) REFERENCES Categories(category_id)
);

-- Bills Table: stores expenses like rent, utilities, etc.
CREATE TABLE Bills (
    bill_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    bill_name VARCHAR(50) NOT NULL,
    bill_amount DECIMAL(10, 2) NOT NULL,
    due_date DATE NOT NULL,
    payment_date DATE,
    paid_status BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Report Table: generates monthly report to let user know about purchases and budget status
CREATE TABLE Report (
    report_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    report_month DATE NOT NULL,
    total_income DECIMAL(10,2) NOT NULL,
    total_expenses DECIMAL(10,2) NOT NULL,
    budget_status ENUM('under budget', 'on budget', 'over budget') NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
