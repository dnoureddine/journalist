

/*join table for User and User and Langue*/
create table user_langue(
    user_id INT NOT NULL,
    langue_id INT NOT NULL,
    PRIMARY KEY(user_id, langue_id)
 )ENGINE = InnoDB;
ALTER TABLE user_langue ADD FOREIGN KEY (user_id) REFERENCES fos_user(id);
ALTER TABLE user_langue ADD FOREIGN KEY (langue_id) REFERENCES langue(id);

/*join table for User and User and  Domaine */
create table user_domaine(
    user_id INT NOT NULL,
    domaine_id INT NOT NULL,
    PRIMARY KEY(user_id, domaine_id)
 )ENGINE = InnoDB;
ALTER TABLE user_domaine ADD FOREIGN KEY (user_id) REFERENCES fos_user(id);
ALTER TABLE user_domaine ADD FOREIGN KEY (domaine_id) REFERENCES domaine(id);


/*join table for User and User and  tools */
create table user_tools(
    user_id INT NOT NULL,
    tools_id INT NOT NULL,
    PRIMARY KEY(user_id, tools_id)
 )ENGINE = InnoDB;
ALTER TABLE user_tools ADD FOREIGN KEY (user_id) REFERENCES fos_user(id);
ALTER TABLE user_tools ADD FOREIGN KEY (tools_id) REFERENCES domaine(id);