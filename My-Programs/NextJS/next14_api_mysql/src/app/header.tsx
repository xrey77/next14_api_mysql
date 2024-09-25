'use client';

import Link from 'next/link'
import React from 'react'
import Image from 'next/image'
import logo from './public/next.svg';
import userpic from './public/users/pix.jpg';

import styles from './page.module.css';
import Signin from './[auth]/signin';
import Signup from './[auth]/signup';

export default function Header() {

  const getFromLocalStorage = (key: string) => {
    if (!key || typeof window === 'undefined') {
        return ""
    }
    return localStorage.getItem(key)
  }
  const user = { username: getFromLocalStorage('USERNAME') ? JSON.parse(getFromLocalStorage('USERNAME') || '{}') : []};
  let username: any = user.username.username === undefined ? null : user.username.username

  const signOut = () => {
    localStorage.removeItem('USERID')
    localStorage.removeItem('USERNAME')
    localStorage.removeItem('USERPIC')
    localStorage.removeItem('TOKEN')
    window.location.href = "/"
  }

  return (
    <>
    <header>
<nav className="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div className="container-fluid">
    <Link className="navbar-brand" href={'/'} ><Image className={styles.xlogo} src={logo} alt=''/></Link>
     <button className='navbar-toggler' type='button' data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      <span className="navbar-toggler-icon"></span>
    </button>
    <div className="collapse navbar-collapse" id="navbarSupportedContent">
      <ul className="navbar-nav me-auto mb-2 mb-lg-0">
        <li className="nav-item">
          <Link className="nav-link active" aria-current="page" href={'/about'}>About Us</Link>
        </li>
        <li className="nav-item dropdown">
          <a className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Products
          </a>
          <ul className="dropdown-menu">
            <li><a className="dropdown-item" href="#">Product 1</a></li>
            <li><a className="dropdown-item" href="#">Product 2</a></li>
            <li><hr className="dropdown-divider"/></li>
            <li><a className="dropdown-item" href="#">Product 3</a></li>
          </ul>
        </li>
        <li className="nav-item">
          <Link className="nav-link" href={'/contact'}>Contact Us</Link>
        </li>
      </ul>

    {
      username === null ?
      <ul className="navbar-nav mr-auto">
        <li className="nav-item">
          <a className="nav-link active" aria-current="page" href="#/" data-bs-toggle="modal" data-bs-target="#staticSigninBackdrop">Signin</a>
        </li>
        <li className="nav-item">
          <a className="nav-link active" aria-current="page" href="#/" data-bs-toggle="modal" data-bs-target="#staticSignupBackdrop">Signup</a>
        </li>
    </ul>
: 
        <div className={styles.unameleft}>
         <li className="nav-item dropdown">
           <a className="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <span className={styles.user}><Image className={styles.user} src={userpic} alt=''/></span>&nbsp;<span>{username}</span>
           </a>
           <ul className={'dropdown-menu styles.unameleft'}>
             <li><a onClick={signOut} className="dropdown-item" href="#/">Signout</a></li>
             <li><Link className="dropdown-item" href={'/profile'}>Profile</Link></li>
             <li><hr className="dropdown-divider"/></li>
             <li><a className="dropdown-item" href="#/">Messenger</a></li>
           </ul>
         </li>
         </div>  
}





    </div>
  </div>
</nav>
</header>

{/* DRAWER MENU */}
<div className={"offcanvas offcanvas-end styles.drawermenu"} tabIndex={-1} id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div className="offcanvas-header bg-secondary">
    <h5 className="offcanvas-title text-white" id="offcanvasExampleLabel">Drawer Menu</h5>
    <button type="button" className="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div className="offcanvas-body">

  <ul className="nav flex-column">
  <li className="nav-item" data-bs-dismiss="offcanvas">
    <Link className="nav-link active" aria-current="page" href={'/about'}>About Us</Link>
  </li>
  <hr/>
  <li className="nav-item dropdown">
    <a className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Products
    </a>
    <ul className="dropdown-menu">
      <li data-bs-dismiss="offcanvas"><a className="dropdown-item" href="#">Product 1</a></li>
      <li><hr className="dropdown-divider"/></li>
      <li data-bs-dismiss="offcanvas"><a className="dropdown-item" href="#">Product 2</a></li>
      <li><hr className="dropdown-divider"/></li>
      <li data-bs-dismiss="offcanvas"><a className="dropdown-item" href="#">Product 3</a></li>
    </ul>
  </li>
  <hr/>
  <li className="nav-item" data-bs-dismiss="offcanvas">
    <Link className="nav-link" href={'/contact'}>Contact Us</Link>
  </li>
  <hr/>
  {
      username === null ?

      <ul className="navbar-nav mr-auto">
        <li className="nav-item" data-bs-dismiss="offcanvas">
          <Link className="nav-link active text-primary" href={'#/'} data-bs-toggle="modal" data-bs-target="#staticSigninBackdrop">&nbsp;&nbsp;&nbsp;Signin</Link>
        </li>
      <hr/>    
      <li className="nav-item" data-bs-dismiss="offcanvas">
        <Link className="nav-link active text-primary" href={'#/'} data-bs-toggle="modal" data-bs-target="#staticSignupBackdrop">&nbsp;&nbsp;&nbsp;Signup</Link>
      </li>              
    </ul>    
  : 
        <div>
         <li className="nav-item dropdown">
           <a className="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <span className={styles.user}><Image className={styles.user} src={userpic} alt=''/></span>&nbsp;<span>{username}</span>
           </a>
           <ul className={'dropdown-menu styles.unameleft'}>
             <li data-bs-dismiss="offcanvas"><a onClick={signOut} className="dropdown-item" href="#/">Signout</a></li>
             <li><hr className="dropdown-divider"/></li>
             <li data-bs-dismiss="offcanvas"><Link className="dropdown-item" href={'/profile'}>Profile</Link></li>
             <li><hr className="dropdown-divider"/></li>
             <li data-bs-dismiss="offcanvas"><a className="dropdown-item" href="#/">Messenger</a></li>
           </ul>
         </li>
         </div>  
    }
  <hr/>
</ul>
  </div>
</div>


<Signin/>
<Signup/>
</>
  )
}
