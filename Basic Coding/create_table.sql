create table user_review(
    id int(10) auto_increment primary key, 
    order_id varchar(30), 
    product_id varchar(30), 
    user_id varchar(30), 
    rating float(1), 
    review varchar(500), 
    created_at datetime default current_timestamp, 
    updated_at datetime default current_timestamp on update current_timestamp, 
    check(rating >= 1 AND rating <= 5) 
);