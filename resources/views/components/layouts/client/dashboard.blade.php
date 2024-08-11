<x-layouts.client.app>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <x-navigation.client.sidebar />

            <!-- Main Content -->
            <div class="col-10 content">
                <!-- Navbar with Extra Controls -->
                <x-navigation.client.navbar />

                <!-- CONTENT -->
                {{$slot}}
            </div>
        </div>
    </div>

</x-layouts.client.app>


