import React from "react";

function Header() {
  return (
    <header className="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
      <div className="m-header">
        <a className="mobile-menu" id="mobile-collapse" href="#!">
          <span></span>
        </a>
        <a href="#!" className="b-brand">
          {/* Logo */}
          <img src="assets/images/logo.png" alt="Logo" className="logo" />
          <img src="assets/images/logo-icon.png" alt="Logo Icon" className="logo-thumb" />
        </a>
        <a href="#!" className="mob-toggler">
          <i className="feather icon-more-vertical"></i>
        </a>
      </div>

      <div className="collapse navbar-collapse">
        <ul className="navbar-nav mr-auto">
          <li className="nav-item">
            <a href="#!" className="pop-search">
              <i className="feather icon-search"></i>
            </a>
          </li>
        </ul>

        <ul className="navbar-nav ml-auto">
          <li>
            <div className="dropdown drp-user">
              <a href="#" className="dropdown-toggle" data-toggle="dropdown">
                <i className="feather icon-user"></i>
              </a>
              <div className="dropdown-menu dropdown-menu-right profile-notification">
                <div className="pro-head">
                  <img src="assets/images/user/avatar-1.jpg" className="img-radius" alt="User" />
                  <span>John Doe</span>
                  <a href="auth-signin.html" className="dud-logout" title="Logout">
                    <i className="feather icon-log-out"></i>
                  </a>
                </div>
                <ul className="pro-body">
                  <li>
                    <a href="user-profile.html" className="dropdown-item">
                      <i className="feather icon-user"></i> Profile
                    </a>
                  </li>
                  <li>
                    <a href="email_inbox.html" className="dropdown-item">
                      <i className="feather icon-mail"></i> My Messages
                    </a>
                  </li>
                  <li>
                    <a href="auth-signin.html" className="dropdown-item">
                      <i className="feather icon-lock"></i> Lock Screen
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </header>
  );
}

export default Header;
