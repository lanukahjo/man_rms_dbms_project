Create table Distributor(
    dist_id INT,
    email_id varchar(30),
    phone_no char(10),
    dist_name varchar(20),
    Primary Key(dist_id)
);

Create table Category(
    cat_id varchar(6),
    cat_name varchar(20),
    Primary Key(cat_id)
);

Create table Employee(
    emp_id varchar(6),
    fname varchar(10),
    lname varchar(10),
    phone_no char(10),
    email_id varchar(30),
    birth_date date,
    hire_date date,
    pos varchar(10),
    gender varchar(10),
    salary double(6,2),
    cat_id varchar(6),
    supervisor_id varchar(6),
    Primary Key(emp_id),
    Foreign Key(cat_id) References Catogory(cat_id),
    Foreign Key(supervisor_id) References Employee(emp_id)
);

Create table LoginCredentials(
    login_id varchar(10),
    passwd varchar(20),
    login_type varchar(6),
    emp_id varchar(6),
    Primary Key(login_id),
    Foreign Key(emp_id) References Employee(emp_id)
);

Create Table Shift(
    entr_date date,
    emp_id varchar(6),
    start_time timestamp,
    end_time timestamp,
    Primary Key(entr_date,emp_id),
    Foreign Key(emp_id) References Employee(emp_id)
);

Create table item(
    item_id varchar(6),
    manufacture_date date,
    expiry_date date,
    cost_price double(5,2),
    sale_price double(5,2),
    marked_price double(5,2),
    item_name varchar(20),
    cat_id varchar(6),
    Primary Key(item_id),
    Foreign Key(cat_id) References Catogory(cat_id)
);

Create table Customer(
    cust_id varchar(6),
    fanme varchar(10),
    lname varchar(10),
    gender varchar(10),
    birth_date date,
    Primary Key(cust_id)
);

Create table SalesRecord(
    sale_id varchar(6),
    sale_date date,
    amount double(6,2),
    emp_id varchar(6) NOT NULL,
    cust_id varchar(6) NOT NULL,
    Primary Key(sale_id),
    Foreign Key(emp_id) References Employee(emp_id),
    Foreign Key(cust_id) References Customer(cust_id)
);

Create table PurchaseRecord(
    purchase_id varchar(6),
    purchase_date date,
    amount double(6,2),
    emp_id varchar(6) NOT NULL,
    dist_id varchar(6) NOT NULL,
    Primary Key(purchase_id),
    Foreign Key(emp_id) References Employee(emp_id),
    Foreign Key(dist_id) References Distributor(dist_id)
);

Create table Bill_Items(
    item_id varchar(6),
    sale_id varchar(6),
    Primary Key(item_id,sale_id),
    Foreign Key(item_id) References item(item_id),
    Foreign Key(sale_id) References SalesRecord(sale_id)
);

Create table Purchase_Items(
    item_id varchar(6),
    purchase_id varchar(6),
    Primary Key(item_id,purchase_id),
    Foreign Key(item_id) References item(item_id),
    Foreign Key(purchase_id) References PurchaseRecord(purchase_id)
);