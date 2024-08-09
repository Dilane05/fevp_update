INSERT INTO indicators (name, min_value, max_value, base_score, factor, additional_score, condition_type) VALUES
('performance', 0, 80, 0, 0, NULL, 'range'),
('performance', 80, 100, 50, 50/20, NULL, 'range'),
('performance', 100, 110, 100, 5/10, NULL, 'range'),
('performance', 110, 200, 105, 0, NULL, 'range'),
('execution', 0, 80, 0, 0, NULL, 'range'),
('execution', 80, 100, 50, 50/20, NULL, 'range'),
('budget', 0, 85, 105, 0, NULL, 'range'),
('budget', 85, 100, 105, -25/15, NULL, 'range'),
('budget', 100, 105, 50, -50/5, NULL, 'range'),
('budget', 105, 200, 0, 0, NULL, 'range');
