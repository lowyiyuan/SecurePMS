<?php

echo'<nav class="navbar navbar-expand-lg navbar-light py-3 bg-light">
        <div class="container">
            <a class="navbar-brand" href="index">SecurePMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewPassword">Passwords</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            '. $_SESSION['username'] .'
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="include/logout.inc">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>';