CREATE OR REPLACE VIEW v_departement_employe AS
SELECT 
    employees.emp_no,
    employees.first_name,
    employees.last_name,
    employees.birth_date,
    employees.gender,
    employees.hire_date,
    dept_emp.dept_no,
    departments.dept_name,
    dept_emp.from_date AS dept_from_date,
    dept_emp.to_date AS dept_to_date
FROM employees
JOIN dept_emp ON employees.emp_no = dept_emp.emp_no
JOIN departments ON dept_emp.dept_no = departments.dept_no;

CREATE OR REPLACE VIEW v_departement_manager AS
SELECT 
    employees.*,
    dept_manager.dept_no,
    dept_manager.from_date AS dept_from_date,
    dept_manager.to_date AS dept_to_date,
    departments.dept_name
FROM employees
JOIN dept_manager ON employees.emp_no = dept_manager.emp_no
JOIN departments ON dept_manager.dept_no = departments.dept_no;

CREATE OR REPLACE VIEW v_emp_salaire AS
SELECT
    employees.*,
    salaries.salary,
    salaries.from_date,
    salaries.to_date
FROM employees
JOIN salaries ON employees.emp_no = salaries.emp_no;

CREATE OR REPLACE VIEW v_emp_titre AS
SELECT
    employees.*,
    titles.title,
    titles.from_date,
    titles.to_date
FROM employees
JOIN titles ON employees.emp_no = titles.emp_no;