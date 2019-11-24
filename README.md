# repair-station-app-with-laravel

 <h2>نرم افزار مبتنی بر وب مدیریت تعمیرگاه (کامپیوتر، لپ تاپ و تجهیزات جانبی)</h2>
 
 
 <h4>سایر ویژگی های کلیدی:</h4>
 

- امکان ثبت مشتری و دستگاه های تعمیری 

- تغییر وضعیت تعمیری به یکی از چهار حالت زیر
        <ul>
            <li>انصراف مشتری</li>
            <li>در حال تعمیر</li>
            <li>تعمیر شده</li>
            <li>غیرقابل تعمیر</li>
        </ul>
   
- امکان ثبت تمامی پرداختی های مشتری با تاریخ

- امکان ثبت هزینه های تعمیر با جزئیات و همچنین سود خالص تعمیرگاه از هر تعمیر

- احراز هویت

- پنل نمایش وضعیت کلی سیستمو تاریخ میلادی و شمسی

- ثبت یادآور ها در بازه های زمانی خاص

- استعلام وضعیت تعمیری ها

- قابلیت ثبت تاریخ ها در دیتابیس به صورت شمسی

- قابلیت جستجو در میان تمامی تعمیری ها با کد شناسایی، نام مشتری، وضعیت دستگاه و ...

- دسترسی به تعمیری ها و صورت حساب های تک تک مشتریان بصورت جداگانه

- لینک ها ی جداگانه جهت نمایش تعمیری های :
    - در حال تعمیر
    - آماده تحویل

- تنظیم تعداد رکوردهای نمایش داده شده در هر صفحه


 <h4>تکنولوژی ها، زبان ها، کتابخانه ها و فریمورک های مورد استفاده:</h4>``````

 - html & css & bootstrap & javascript & jquery
 - laravel 5.8 & php >= 7.2
 - MySql >= 5.7
 


 <h4>پیشنیازها جهت نصب :</h4>``````

 - mysql >= 5.7
 - php >= 7.2
 - composer
 - laravel installer
 - git
 - google chrome or firefox (ver >= 60)
 

- نحوه راه اندازی برنامه در localhost

    - run `git clone https://www.github.com/mehrannasr375/repair-station-app-with-laravel.git`
    - `cd` to project directory
    - run `composer update`
    - add a user to mysql and use it in `.env` file on `DB_USERNAME` and `DB_PASSWORD`
    - run `php artisan migrate:fresh --seed` for make and seed the database
    - search for `localhost:8000` with a browser to run the project



