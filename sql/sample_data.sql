-- =============================================
-- Sample Data for LAHS Toposcope Journal
-- =============================================

-- Insert Membership Classes
INSERT INTO membership_class (class_name, description) VALUES
('Subscriber', 'Regular subscriber to Newsletters and limited access'),
('Premium', 'Premium subscriber with full access'),
('Administrator', 'System administrator'),
('Guest', 'Guest or limited access');

-- Insert Sample Users
INSERT INTO users (username, email, password_hash, first_name, last_name) VALUES
('robc', 'rob@crothall.co.za', '', 'Rob', 'Crothall'),
('asmith', 'alice.smith@lahs.edu', 'hashed_password_here', 'Alice', 'Smith'),
('admin', 'admin@lahs.edu', 'hashed_password_here', 'Admin', 'User');

-- Assign Membership Classes to Users
INSERT INTO user_membership_class (user_id, membership_class_id, date_assigned) VALUES
(1, 3, GETDATE()),  -- robc as Subscriber
(2, 2, GETDATE()),  -- asmith as Premium
(3, 3, GETDATE()); -- admin as Administrator

-- Insert Documents
INSERT INTO documents (doc_name, file_path, description, file_size) VALUES
('LAHS_Toposcope_Online_and_Newsletters_20260418.pdf', 
 '../public/docs/LAHS_Toposcope_Online_and_Newsletters_20260418.pdf',
 'LAHS Toposcope Online and Newsletters - April 18, 2026',
 NULL);
