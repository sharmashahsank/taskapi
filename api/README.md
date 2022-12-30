# Task API Module

This is a example application that created task and notes against the task and user authentication using JWT Authentication. It exposes following endpoints

- `api/login.php`
- `api/register.php`
- `api/addTask.php`


## API End Points Payloads Data


- `api/register.php` - POST

-- Headers 
Content-Type : application/json

-- Body

{
    "first_name": "Mahesh",
    "last_name": "Sharma",
    "email": "maheshsharmatest@gmail.com",
    "password": "123456789"
}

- `api/login.php` - POST

-- Headers 
Content-Type : application/json

-- Body

{
    "email": "maheshsharmatest@gmail.com",
    "password": "123456789"
}


- `api/addTask.php` - POST

-- Headers 
Content-Type : application/json
Authorization : Bearer <JWT_Token>

-- Body

{
    "subject": "My First Task",
    "description" : "description for first task",
    "start_date": "2022-12-29",
    "due_date": "2023-02-01",
    "status": 1,
    "priority": 2,
    "notes": [
        {
            "subject": "my first subject note",
            "attachments": [
                {"filename":"test.jpg"},
                {"filename":"test2.png"},
                {"filename":"test.docx"}
            ],
            "note": "My note text"
        },
        {
            "subject": "my first subject note",
            "attachments": [
                {"filename":"front.jpg"},
                {"filename":"test.pdf"},
                {"filename":"mydoc.csv"}
            ],
            "note": "My note text"
        }
    ]
}

- `api/taskList.php` - GET

-- Headers 
Content-Type : application/json
Authorization : Bearer <JWT_Token>



## How to Run This App

- clone the application from git repo
- Import database sql file
- configure database in config.php
- run "composer update" on the root of directory
- Run end points as mentioned above.