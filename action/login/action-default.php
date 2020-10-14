<script src="js/session.js"></script>


<body class="layout-row">
    <div class="flex">
        <div class="w-xl w-auto-sm mx-auto py-5">
            <div class="p-4 d-flex flex-column h-100">
                <!-- brand -->
                <a href="#" class="navbar-brand align-self-center">
                    <svg width="32" height="32" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor">
                        <g class="loading-spin" style="transform-origin: 256px 256px">
                            <path
                                d="M200.043 106.067c-40.631 15.171-73.434 46.382-90.717 85.933H256l-55.957-85.933zM412.797 288A160.723 160.723 0 0 0 416 256c0-36.624-12.314-70.367-33.016-97.334L311 288h101.797zM359.973 134.395C332.007 110.461 295.694 96 256 96c-7.966 0-15.794.591-23.448 1.715L310.852 224l49.121-89.605zM99.204 224A160.65 160.65 0 0 0 96 256c0 36.639 12.324 70.394 33.041 97.366L201 224H99.204zM311.959 405.932c40.631-15.171 73.433-46.382 90.715-85.932H256l55.959 85.932zM152.046 377.621C180.009 401.545 216.314 416 256 416c7.969 0 15.799-.592 23.456-1.716L201.164 288l-49.118 89.621z">
                            </path>
                        </g>
                    </svg>
                    <!-- <img src="../assets/img/logo.png" alt="..."> -->
                    <span class="hidden-folded d-inline l-s-n-1x align-self-center">Saie</span>
                </a>
                <!-- / brand -->
            </div>
            <div class="card">
                <div id="content-body">
                    <div class="p-3 p-md-5">
                        <h5>Bienvenido</h5>
                        <p>
                            <small class="text-muted">Inicia sesión para comenzar</small>
                        </p>
                        <form role="form" method="post" id="login-form" action="login.php">

                            <input type="hidden" id="rut" name="rut" value="">
                            <input type="hidden" id="dv" name="dv" value="">

                            <div class="alert alert-danger" id="alerta-session" role="alert">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="run" id="run" placeholder="RUN"
                                    onchange="ejecuta_opcion()" autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Contrase&ntilde;a">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox mb-3">
                                <label class="ui-check">
                                    <input type="checkbox">
                                    <i></i> Recuerdame
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mb-4"><i class="fas fa-unlock"></i>
                                Acceder</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center text-muted">&copy; 2020 Carlos Morales</div>
        </div>
    </div>
    <!-- build:js ../assets/js/site.min.js -->
        <!-- jQuery -->
        <script src="./libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="./libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="./libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- ajax page -->
        <script src="./libs/pjax/pjax.min.js"></script>
        <script src="./assets/js/ajax.js"></script>
        <!-- lazyload plugin -->
        <script src="./assets/js/lazyload.config.js"></script>
        <script src="./assets/js/lazyload.js"></script>
        <script src="./assets/js/plugin.js"></script>
        <!-- scrollreveal -->
        <script src="./libs/scrollreveal/dist/scrollreveal.min.js"></script>
        <!-- feathericon -->
        <script src="./libs/feather-icons/dist/feather.min.js"></script>
        <script src="./assets/js/plugins/feathericon.js"></script>
        <!-- theme -->
        <script src="./assets/js/theme.js"></script>
        <script src="./assets/js/utils.js"></script>
        <!-- endbuild -->
</body>