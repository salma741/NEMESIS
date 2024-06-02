<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Other head elements -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .card {
          transition: transform 0.3s, box-shadow 0.3s;
            background-color: #f06c14 !important; /* Set the desired background color */
            border: 1px solid rgb(243, 121, 6);
            border-radius: 10px;/* Ensure text is readable on the new background */
        }
        .card .card-body h5,
        .card .card-body p{
          color: white;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card.clicked {
            animation: bounce 0.6s;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }

        .section-heading {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-heading h2 {
            font-size: 2.5rem;
            color: #343a40;
        }

        .section-heading img {
            margin: 20px 0;
        }

        .section-heading p {
            font-size: 1.1rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <!-- Other body elements -->
    @yield('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const cards = document.querySelectorAll('.card-square');

            cards.forEach(card => {
                card.addEventListener('click', () => {
                    // Remove the 'clicked' class from all cards
                    cards.forEach(c => c.classList.remove('clicked'));
                    // Add the 'clicked' class to the clicked card
                    card.classList.add('clicked');
                });
            });
        });
    </script>
</body>
</html>
