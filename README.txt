GILILA PORTFOLIO — UPDATED TO MATCH THE MESSAGES.PHP DESIGN

Files:
- index.php: portfolio page, styled to match messages.php and saves contact form submissions to MySQL.
- messages.php: inbox page that displays saved messages.
- style.css: shared dark-purple portfolio/inbox design.

Setup:
1. Put all three files in the same folder inside your XAMPP htdocs directory.
2. Start Apache and MySQL from the XAMPP Control Panel.
3. Open http://localhost/your-folder-name/index.php
4. Submit a test message from the Contact section.
5. Open http://localhost/your-folder-name/messages.php to see saved messages.

Important:
- index.php and messages.php currently use the same database name: firtuna_portfolio.
- The database and messages table are created automatically when the pages connect successfully.
- Update the database settings in BOTH PHP files if your MySQL username/password or database name is different.
- The profile visual uses a letter monogram, so no profile image file is required.
