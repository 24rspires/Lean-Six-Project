
import re

def extract_foreign_keys(sql):
    foreign_keys = []
    # Regular expression pattern to match FOREIGN KEY constraints
    pattern = r"FOREIGN KEY \((.*?)\) REFERENCES (.*?)\((.*?)\)"
    matches = re.findall(pattern, sql)
    for match in matches:
        foreign_key_str = {
            "origin": match[0],
            "reference": match[1]
        }
        foreign_keys.append(foreign_key_str)
    return foreign_keys

# SQL statements
create_statement = """
CREATE TABLE Accounts (
    account_id INT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(20),
    address VARCHAR(255)
);

CREATE TABLE Properties (
    property_id INT PRIMARY KEY,
    owner_id INT,
    address VARCHAR(255),
    city VARCHAR(100),
    state VARCHAR(50),
    zipcode VARCHAR(20),
    price DECIMAL(12,2),
    square_feet INT,
    bedrooms INT,
    bathrooms INT,
    listing_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_owner FOREIGN KEY (owner_id) REFERENCES Accounts(account_id)
);

CREATE TABLE Media (
    media_id INT PRIMARY KEY,
    media_type VARCHAR(50),
    file_path VARCHAR(255)
);

CREATE TABLE Property_Media (
    property_id INT,
    media_id INT,
    PRIMARY KEY (property_id, media_id),
    CONSTRAINT fk_property FOREIGN KEY (property_id) REFERENCES Properties(property_id),
    CONSTRAINT fk_media FOREIGN KEY (media_id) REFERENCES Media(media_id)
);
"""

from query_buster import get_buster

buster = get_buster()
cur = buster.cursor()

foreign_keys = extract_foreign_keys(create_statement)
for fk in foreign_keys:
    cur.execute(f'ALTER TABLE {fk.get("reference")} DROP FOREIGN KEY {fk.get("origin")}')

buster.commit()
buster.close()