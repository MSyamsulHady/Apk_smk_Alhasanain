<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item toggle-nav-search hidden-caret">
                <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false"
                    aria-controls="search-nav">
                    <i class="fa fa-search"></i>
                </a>
            </li>
            {{-- <h3 class="ms-2 white text-white mr-3 mt-2">{{ Auth::User()-> }}</h3>
             --}}


            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <h4 class="ms-2 white text-white mr-3 mt-2" id="semesterTrigger">
                        {{ Session::get('semester')->tahun_ajaran . ' ' . Session::get('semester')->nama_semester }}
                    </h4>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn" id="semesterDropdown">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        {{-- @foreach ($semesters as $semester)
                            <li>
                                <a class="dropdown-item" href="#" data-id="{{ $semester->id }}">
                                    {{ $semester->tahun_ajaran . ' ' . $semester->nama_semester }}
                                </a>
                            </li>
                        @endforeach
                    </div> --}}
                </ul>
            </li>

            <!-- Dropdown -->
            <div id="semesterDropdown" class="dropdown-menu" style="display: none;">
                <!-- Loop through available semesters -->

            </div>

            @auth
                @if (auth()->user()->role == 'Guru' && auth()->user()->guru)
                    <h3 class="ms-2 white text-white mr-3 mt-2">{{ auth()->user()->guru->nama }}</h3>
                @else
                    <h3 class="ms-2 white text-white mr-3 mt-2">{{ Auth::User()->username }}</h3>
                @endif
            @endauth

            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="{{ asset('asset_backend') }}/img/profile.jpg" alt="..."
                            class="avatar-img rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg"><img src="{{ asset('asset_backend') }}/img/profile.jpg"
                                        alt="image profile" class="avatar-img rounded"></div>
                                <div class="u-text">
                                    <h4> @auth
                                            @if (auth()->user()->role == 'Guru' && auth()->user()->guru)
                                                <h3 class="ms-2  text-black mr-3 mt-2">{{ auth()->user()->guru->nama }}
                                                </h3>
                                            @else
                                                <h3 class="ms-2 black text-black mr-3 mt-2">{{ Auth::User()->username }}
                                                </h3>
                                            @endif
                                        @endauth
                                    </h4>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="logout" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>



</nav>
<script>
    $(document).ready(function() {
        $('#semesterTrigger').click(function() {
            $('#semesterDropdown').toggle();
        });

        $('#semesterDropdown .dropdown-item').click(function(e) {
            e.preventDefault();
            var semesterId = $(this).data('id');

            $.ajax({
                url: '/semester/update/' + semesterId, // Endpoint AJAX
                type: 'GET',
                success: function(response) {
                    // Update session and page content
                    $('#semesterTrigger').text(response.tahun_ajaran + ' ' + response
                        .nama_semester);
                    alert('Semester updated successfully.');
                },
                error: function(xhr) {
                    alert('Error updating semester.');
                }
            });
        });

        $(document).click(function(event) {
            if (!$(event.target).closest('#semesterTrigger').length &&
                !$(event.target).closest('#semesterDropdown').length) {
                $('#semesterDropdown').hide();
            }
        });
    });
</script>
