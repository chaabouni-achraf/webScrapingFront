
    <div class="right-sidebar">
        <div class="sidebar-title">
            <h3 class="weight-600 font-16 text-blue">
                Layout Settings
                <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
            </h3>
            <div class="close-sidebar" data-toggle="right-sidebar-close">
                <i class="icon-copy ion-close-round"></i>
            </div>
        </div>
        <div class="right-sidebar-body customscroll">
            <div class="right-sidebar-body-content">
                <h4 class="weight-600 font-18 pb-10">Header Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
                <div class="sidebar-radio-group pb-10 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
                        <label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
                        <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
                        <label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
                    </div>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
                <div class="sidebar-radio-group pb-30 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
                        <label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
                        <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
                        <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
                        <label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
                        <label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
                        <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
                    </div>
                </div>

                <div class="reset-options pt-30 text-center">
                    <button class="btn btn-danger" id="reset-settings">Reset Settings</button>
                </div>
            </div>
        </div>
    </div>

    <div class="left-side-bar">
        <div class="brand-logo">
            
            <a href="{{route('acceuil')}}">
               <center><h2 class="DORE">DD PRO</h2></center>
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                 @if(Auth::guard('admin')->user()->role=='super admin')
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-house-1"></span><span class="mtext"> ACCEUIL</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('acceuil')}}">Acceuil</a></li>
                           
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon fa-user fa"></span><span class="mtext">CLIENTES</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('Ajoutcliente')}}">Ajouter cliente</a></li>
                            <li><a href="{{route('listCliente')}}">liste de clientes</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon  fa-book fa"></span><span class="mtext">COMMANDE</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('AjoutCommande')}}">Ajouter commande </a></li>
                            <li><a href="{{route('ListCommande')}}">liste de commandes </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon fa-book fa"></span><span class="mtext">LOCATION</span>
                        </a>
                        <ul class="submenu">
                           
                        <li><a href="{{route('AjoutLocation')}}">Ajouter location </a></li>
                            <li><a href="{{route('ListLocation')}}">liste de locations </a></li>
                        </ul>
                    </li>
                     <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon fa-image fa"></span><span class="mtext">GALERIE</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('Ajoutgalerie')}}">Ajouter modèle</a></li>
                            <li><a href="{{route('ListGalery')}}">liste de modèle </a></li>
                            <li><a href="{{route('Galeries')}}">Galerie </a></li>
                        </ul>
                    </li>
                       <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa-calendar fa"></span><span class="mtext">RENDEZ-VOUS</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="">liste de rendez-vous</a></li>
                            <li><a href="">Calendrier</a></li>
                        </ul>
                    </li>

                        <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon fa-dollar fa"></span><span class="mtext">RECETTES
                               </span>
                        </a>
                        <ul class="submenu">
                            <li><a href="">liste de recettes </a></li>
                           
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon fa-user fa"></span><span class="mtext">ADMINISTRATION</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('Ajoutadmin')}}">Ajouter admin</a></li>
                            <li><a href="{{route('listadmin')}}">Liste de admins</a></li>
                        </ul>
                    </li>

                </ul>
                
                @endif
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>