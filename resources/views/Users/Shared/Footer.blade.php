<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Finder Footer</title>
    <link rel="stylesheet" href=" {{ asset('css/users/footer.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <footer class="footer">
        <div class="container">
            <div class="footer-section about">
                <h3 style="margin-bottom: 10px">About us</h3>
                <p>We help students find their perfect match.</p>
                <div class="social-icons">
                    <a href="https://www.facebook.com/" class="fa fa-facebook"></a>
                    <a href="https://x.com/" class="fa fa-twitter"></a>
                    <a href="https://www.instagram.com/" class="fa fa-instagram"></a>
                </div>
            </div>

            <div class="footer-section links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href=" {{ route('user.searchcollege') }} ">College Search</a></li>
                    <li><a href=" {{ route('user.compare') }} ">College Compare</a></li>
                    <li><a href=" {{ route('user.aboutus') }} ">About Us</a></li>
                    <li><a href=" {{ route('user.contactus') }} ">Contact Us</a></li>
                </ul>
            </div>

            <div class="footer-section contact">
                <h3 style="margin-bottom: 8px">Contact</h3>
                <p style="margin-bottom: 10px">Islington College, Kamal Marg, Kathmandu</p>
                <p style="margin-bottom: 10px">Telephone:<a href="tel:+977 9849808773">+977 9849808773</a></p>
                <p>Email: <a href="mailto:supportcollegefinder@gmail.com">supportcollegefinder@gmail.com</a></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>©2025 College Finder</p>
        </div>
    </footer>

</body>
</html>
