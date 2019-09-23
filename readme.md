<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Hello Max! If would some one get this response with 1000 vacancies :) 


{{host}}/api/organization/1?vacancies=1&workers=1 - architecture is unreal and wrong. And my mind does not want do unlogic things... 

Fronend 
have to union {{host}}/api/organization/1 and {{host}}/api/vacancy/{{id}}/workers=1

PS: thanks for my interesting weekend with Lara, Pyro, Pure Developers and uncount number of chats. Woohoo and I catch your BUG in the {{host}}/api/organization/1?vacancies=2&workers=1

## my response which was wrong. Now it is ok:
{{host}}/api/organization/2?vacancies=1&workers=1
{
    "success": true,
    "data": {
        "id": "2",
        "title": "Rerum adipisci dolore rerum.",
        "city": "Parisianstad",
        "country": "Mali",
        "created_at": "2019-09-17 06:07:17",
        "updated_at": "2019-09-17 06:07:17",
        "creator": {
            "id": 3,
            "email": "fschmitt@example.net",
            "first_name": "Cole",
            "last_name": "Lakin",
            "country": "Guatemala",
            "city": "Cambodia",
            "phone": "+14413572327",
            "role": "employer",
            "created_at": "2019-09-17T06:07:16.000000Z",
            "updated_at": "2019-09-17T06:07:16.000000Z"
        },
        "vacancies": [
            {
                "id": 2,
                "vacancy_name": "Ankunding",
                "workers_amount": 3,
                "organization_id": 2,
                "salary": 93694,
                "created_at": "2019-09-17 06:07:21",
                "updated_at": "2019-09-17 06:07:21",
                "organizationmy_id": null,
                "workers_booked": 2,
                "status": "active"
            }
        ],
        "workers": [
            {
                "id": 1,
                "email": "admin@localhost",
                "first_name": "Inna",
                "last_name": "Da",
                "country": "Ukraine",
                "city": "Poltava",
                "phone": "06372391",
                "role": "admin",
                "created_at": "2019-09-17 06:07:16",
                "updated_at": "2019-09-19 11:48:44",
            },
            {
                "id": 2,
                "email": "new_email@localhost1",
                "first_name": "fname1",
                "last_name": "lname",
                "country": "Ukraine",
                "city": "Poltava",
                "phone": "833246",
                "role": "employer",
                "created_at": "2019-09-17 06:07:16",
                "updated_at": "2019-09-19 10:45:56",
            }
        ]
    }
}
## my response for vacancy=2 if we dont have no "active" neither "close" but your response have a BUG in it:
{{host}}/api/organization/2?vacancies=2&workers=1
{
    "success": true,
    "data": {
        "id": "2",
        "title": "Rerum adipisci dolore rerum.",
        "city": "Parisianstad",
        "country": "Mali",
        "created_at": "2019-09-17 06:07:17",
        "updated_at": "2019-09-17 06:07:17",
        "creator": {
            "id": 3,
            "email": "fschmitt@example.net",
            "first_name": "Cole",
            "last_name": "Lakin",
            "country": "Guatemala",
            "city": "Cambodia",
            "phone": "+14413572327",
            "role": "employer",
            "created_at": "2019-09-17T06:07:16.000000Z",
            "updated_at": "2019-09-17T06:07:16.000000Z"
        },
        "vacancies": [],
        "workers": []
    }

    BUT YOUR {{host}}/api/organization/1?vacancies=2&workers=1
    {
    "success": true,
    "data": {
        "id": 1,
        "title": "Reuben Kling",
        "city": "Abelchester",
        "country": "Cote d'Ivoire",
        "created_at": "2019-09-02 10:07:59",
        "updated_at": "2019-09-02 10:07:59",
        "creator": {
            "id": 2,
            "role": "employer",
            "email": "alvis.paucek@example.org",
            "first_name": "Deshawn",
            "last_name": "Nienow",
            "country": "Mauritania",
            "city": "Mosciskishire",
            "phone": "(715) 881-9216",
            "created_at": "2019-09-02 10:07:59",
            "updated_at": "2019-09-02 10:07:59"
        },
        "vacancies": [],
        "workers": [
            {
                "id": 53,
                "role": "worker",
                "email": "mboyer@example.com",
                "first_name": "Bianka",
                "last_name": "Fay",
                "country": "Benin",
                "city": "North Albinstad",
                "phone": "1-368-236-7923 x648",
                "created_at": "2019-09-02 10:08:05",
                "updated_at": "2019-09-02 10:08:05"
            }
        ]
    }
}
}
