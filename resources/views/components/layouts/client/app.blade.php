<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $header ?? 'fevp' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    @livewireStyles
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400&display=swap');

        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, #f6f9fc, #dfe8f3);
            color: #4d4d4d;
            overflow-x: hidden;
        }

        /* .sidebar {
            background-color: #ffffff;
            border-right: 1px solid #dcdcdc;
            min-height: 100vh;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        } */

        /* Style pour la sidebar fixe */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 20%;
            /* Ajustez selon la largeur souhaitée */
            height: 100vh;
            /* Hauteur pleine */
            background-color: #ffffff;
            border-right: 1px solid #dcdcdc;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            /* Assurez-vous que la sidebar est au-dessus du contenu */
        }

        /* Ajustez le contenu principal pour qu'il ne soit pas masqué par la sidebar */
        .content {
            margin-left: 20%;
            /* La même largeur que la sidebar */
            padding: 30px;
        }


        .content {
            padding: 30px;
        }

        .card-custom {
            border-radius: 20px;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .avatar {
            border-radius: 50%;
            width: 70px;
            height: 70px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            color: #6d6d6d;
            font-size: 1.1rem;
            margin-bottom: 05px;
            transition: all 0.2s ease-in-out;
        }


        .nav-link.active {
            color: #7c83fd;
            font-weight: bold;
            background-color: #e6e9ff;
            border-radius: 10px;
        }

        .nav-link:hover {
            color: #4a4a4a;
            font-weight: bold;
        }

        .schedule-item {
            background-color: #f2f5f9;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            color: #5b5b5b;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .icon-container {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #f6f9fc;
            margin-bottom: 20px;
            box-shadow: inset 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2,
        h4 {
            font-weight: 400;
            color: #4d4d4d;
        }

        p {
            font-size: 0.95rem;
            color: #6d6d6d;
        }

        .btn-primary {
            background-color: #7c83fd;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #6a73d4;
        }

        .btn-icon {
            background-color: #f6f9fc;
            border: none;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-icon:hover {
            background-color: #e0e0ff;
            transform: scale(1.1);
        }

        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background: linear-gradient(135deg, #2c2c2c, #1a1a1a);
            color: #f0f0f0;
        }

        .sidebar.dark-mode {
            background-color: #333;
            border-right: 1px solid #555;
        }

        .card-custom.dark-mode,
        .navbar-custom.dark-mode {
            background-color: #444;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.5);
        }

        .nav-link.dark-mode {
            color: #ccc;
        }

        .nav-link.dark-mode:hover {
            color: #fff;
        }

        .schedule-item.dark-mode {
            background-color: #444;
            color: #ccc;
        }

        .icon-container.dark-mode {
            background-color: #333;
        }

        .btn-primary.dark-mode {
            background-color: #6a73d4;
        }

        .btn-icon.dark-mode {
            background-color: #333;
            color: #fff;
        }

        .btn-icon.dark-mode:hover {
            background-color: #444;
        }

        /*style navbar module header */

        .breadcrumb {
            background-color: #f8f9fa;
            font-size: 1rem;
        }

        .breadcrumb-item a {
            transition: color 0.3s;
        }

        .breadcrumb-item a:hover {
            color: #5a67d8;
        }

        .breadcrumb-item.active {
            font-weight: bold;
        }

        .breadcrumb .bi {
            font-size: 1.2rem;
        }

        .breadcrumb .bi-house-door-fill {
            color: #5a67d8;
        }

        .breadcrumb .bi-journal-text {
            color: #3182ce;
        }
    </style>

    @stack('scripts_head')
    @stack('css')
</head>

<body>

    {{ $slot }}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @livewireScripts
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    <x-livewire-alert::flash />

    <script>
        // Initialize Charts
        const ctx1 = document.getElementById('pieChart').getContext('2d');
        const ctx2 = document.getElementById('lineChart').getContext('2d');
        const ctx3 = document.getElementById('columnChart').getContext('2d');

        // Pie Chart
        new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Color1', 'Color2', 'Color3', 'Color4'],
                datasets: [{
                    data: [10, 20, 30, 40],
                    backgroundColor: ['#7c83fd', '#34c38f', '#f46a6a', '#ffce56'],
                }]
            },
        });

        // Line Chart
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                datasets: [{
                    label: 'Latency',
                    data: [20, 30, 40, 30, 20, 10],
                    borderColor: '#7c83fd',
                    fill: true,
                    backgroundColor: 'rgba(124, 131, 253, 0.2)',
                }]
            },
        });

        // Column Chart
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                datasets: [{
                    label: 'Temperature',
                    data: [21, 19, 22, 20, 23, 21],
                    backgroundColor: ['#7c83fd', '#34c38f', '#f46a6a', '#ffce56'],
                }]
            },
        });

        // Theme Toggle
        const themeToggle = document.getElementById('theme-toggle');
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            document.querySelector('.sidebar').classList.toggle('dark-mode');
            document.querySelectorAll('.card-custom').forEach(card => card.classList.toggle('dark-mode'));
            document.querySelector('.navbar-custom').classList.toggle('dark-mode');
            document.querySelectorAll('.nav-link').forEach(link => link.classList.toggle('dark-mode'));
            document.querySelectorAll('.schedule-item').forEach(item => item.classList.toggle('dark-mode'));
            document.querySelectorAll('.icon-container').forEach(icon => icon.classList.toggle('dark-mode'));
            document.querySelectorAll('.btn-primary').forEach(btn => btn.classList.toggle('dark-mode'));
            document.querySelectorAll('.btn-icon').forEach(icon => icon.classList.toggle('dark-mode'));

            if (document.body.classList.contains('dark-mode')) {
                themeToggle.innerHTML = '<i class="bi bi-sun"></i>';
            } else {
                themeToggle.innerHTML = '<i class="bi bi-moon"></i>';
            }
        });

        // Language Toggle
        const translations = {
            en: {
                greeting: "Good morning, Christophe!",
                description: "Find out how easy it is to make your home comfortable, more functional, and more.",
                myJourney: "My journey",
                myProduct: "My product",
                schedule: "Schedule",
                columnChart: "Column Chart",
                logout: "Logout",
                dashboard: "Dashboard",
                product: "Product",
                pricing: "Pricing",
                docs: "Docs"
            },
            fr: {
                greeting: "Bonjour, Christophe !",
                description: "Découvrez à quel point il est facile de rendre votre maison confortable, plus fonctionnelle et plus encore.",
                myJourney: "Mon parcours",
                myProduct: "Mon produit",
                schedule: "Planning",
                columnChart: "Graphique en colonnes",
                logout: "Se déconnecter",
                dashboard: "Tableau de bord",
                product: "Produit",
                pricing: "Tarification",
                docs: "Documents"
            }
        };

        let currentLanguage = 'en';

        const languageToggle = document.getElementById('language-toggle');
        languageToggle.addEventListener('click', () => {
            currentLanguage = currentLanguage === 'en' ? 'fr' : 'en';
            updateLanguage();
        });

        function updateLanguage() {
            document.querySelectorAll('[data-translate]').forEach(el => {
                const key = el.getAttribute('data-translate');
                el.textContent = translations[currentLanguage][key];
            });
        }
    </script>
</body>

</html>
