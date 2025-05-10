<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="stylesheet" href="{{ asset('css/Users/contactus.css') }}">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (document.getElementById('popup')) {
                document.getElementById('popup').style.display = 'block';
            }
        });

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="navbar">
        @include('Users.Shared.Nav')
    </div>
    <h1 class="contactus-header">Contact Us</h1>
    <div class="container">
        <div class="contact-info">
            <p>📍 Islington College, Kamal Marg, Kathmandu</p>
            <p><a href="mailto:supportcollegefinder@gmail.com" class="email-link">✉️ supportcollegefinder@gmail.com</a></p>
            <p>📞 +977 9849808773</p>
            <p><a href="https://www.facebook.com/" class="social-link facebook">Facebook</a> | <a href="https://twitter.com/" class="social-link twitter">Twitter</a> | <a href="https://www.linkedin.com/" class="social-link linkedin">LinkedIn</a> | <a href="https://www.instagram.com/" class="social-link instagram">Instagram</a></p>
        </div>

        <div class="contact-form">
            <form action=" {{ route('user.contactus.store') }} " method="POST">
                @csrf
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required>

                <label for="message" class="form-label">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Send Message</button>
            </form>
            @if(session('success'))
            <div class="overlay" id="overlay" onclick="closePopup()"></div>
            <div class="popup" id="popup">
                <p>Thank you for contacting us!</p>
                <button onclick="closePopup()">OK</button>
            </div>

            <script>
                document.getElementById('popup').style.display = 'block';
                document.getElementById('overlay').style.display = 'block';

                function closePopup() {
                    document.getElementById('popup').style.display = 'none';
                    document.getElementById('overlay').style.display = 'none';
                }
            </script>
            @endif
        </div>
    </div>

    <div class="footer" style="margin-top: 40px">
        @include('Users.Shared.Footer')
    </div>
</body>
</html>
