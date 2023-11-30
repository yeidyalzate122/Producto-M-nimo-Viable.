CREATE TABLE
    Company (
        company_code varchar(10) not null,
        founder varchar(20) not null,
        PRIMARY KEY (company_code)
    );

CREATE TABLE
    Lead_Manager (
        lead_manager_code varchar(10) not null,
        company_code varchar(20) not null,
        PRIMARY KEY (lead_manager_code)
    );

CREATE TABLE
    Senior_Manager (
        senior_manager_code varchar(10) not null,
        lead_manager_code varchar(10) not null,
        company_code varchar(20) not null,
        PRIMARY KEY (senior_manager_code)
    );

CREATE TABLE
    Manager (
        manager_code varchar(10) not null,
        senior_manager_code varchar(10) not null,
        lead_manager_code varchar(10) not null,
        company_code varchar(20) not null,
        PRIMARY KEY (manager_code)
    );

CREATE TABLE
    Empleado (
        employee_code varchar(10) not null,
        manager_code varchar(10) not null,
        senior_manager_code varchar(10) not null,
        lead_manager_code varchar(10) not null,
        company_code varchar(20) not null,
        PRIMARY KEY (employee_code)
    );

/*query*/
SELECT
    co.company_code,
    co.founder,
    COUNT(DISTINCT lm.lead_manager_code) as total_lead_managers, 
    COUNT(DISTINCT sm.senior_manager_code)  as total_senior_manager,  
    COUNT(DISTINCT m.manager_code)  as total_manager, 
    COUNT(DISTINCT e.employee_code)  as empleado
    
FROM
    company co
    INNER JOIN lead_manager lm ON co.company_code = lm.company_code
    INNER JOIN manager m ON co.company_code = m.company_code
    INNER JOIN senior_manager sm ON co.company_code = sm.company_code
    INNER JOIN empleado e ON co.company_code = e.company_code
GROUP BY
    co.company_code, co.founder;

/***Lead_Manager****/
alter table Lead_Manager add foreign key (company_code) references company (company_code);

/***Senior_Manager****/
alter table Senior_Manager add foreign key (lead_manager_code) references lead_manager (lead_manager_code);

alter table Senior_Manager add foreign key (company_code) references company (company_code);

/***Empleado****/
alter table Empleado add foreign key (manager_code) references manager (manager_code);

alter table Empleado add foreign key (senior_manager_code) references senior_manager (senior_manager_code);

alter table Empleado add foreign key (lead_manager_code) references lead_manager (lead_manager_code);

alter table Empleado add foreign key (company_code) references company (company_code);

/***manager****/
alter table manager add foreign key (senior_manager_code) references senior_manager (senior_manager_code);

alter table manager add foreign key (lead_manager_code) references lead_manager (lead_manager_code);

alter table manager add foreign key (company_code) references company (company_code);


/*INSER COMPANY*/
INSERT into
    company
VALUES
    ('c1', 'Monika');

INSERT into
    company
VALUES
    ('c2', 'Samantha');

/*INSERT  lead_manager*/
INSERT into
    lead_manager
VALUES
    ('lm1', 'C1');

INSERT into
    lead_manager
VALUES
    ('lm2', 'C2');

/* insert senior_manager*/
INSERT into
    senior_manager
VALUES
    ('sm1', 'lm1', 'c1');

INSERT into
    senior_manager
VALUES
    ('sm2', 'lm1', 'c1');

INSERT into
    senior_manager
VALUES
    ('sm3', 'lm2', 'c2');

/*insert Manager*/
INSERT into
    Manager
VALUES
    ('m1', 'sm1', 'lm1', 'c1');

INSERT into
    Manager
VALUES
    ('m2', 'sm3', 'lm2', 'c2');

INSERT into
    Manager
VALUES
    ('m3', 'sm3', 'lm2', 'c2');

/*insert empleado*/
INSERT into
    empleado
VALUES
    ('e1', 'm1', 'sm1', 'lm1', 'c1');

INSERT into
    empleado
VALUES
    ('e2', 'm1', 'sm1', 'lm1', 'c1');

INSERT into
    empleado
VALUES
    ('e3', 'm2', 'sm3', 'lm2', 'c2');

INSERT into
    empleado
VALUES
    ('e4', 'm3', 'sm3', 'lm2', 'c2');