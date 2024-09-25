'use client'

import styles from '../page.module.css';
import React, { useState } from 'react'
import $ from 'jquery';
import Mfa from './Mfa';

export default function Signin() {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [message, setMessage] = useState('');
  const [disable, setDisable] = useState(false);

  const signIn = async (event: any) => {
    event.preventDefault();
    setDisable(true);
    setMessage("Please wait..");
    let response = await fetch('/api/users/signin', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        "username": username,
        "password": password})            
    }).catch((e: any) => {
      setMessage(e.message);
      setDisable(false);
      return;
    });

    const result = await response?.json()
    if (result.status == 200) {
      setMessage(result.message);

      const usrid =JSON.stringify({userid: result.id});
      const usrpic =JSON.stringify({username: result.profilepic});
      const token =JSON.stringify({token: null});

      localStorage.setItem('USERID', usrid);
      localStorage.setItem('USERPIC', usrpic);
      localStorage.setItem('TOKEN', token);

      if (result.qrcode !== null) {
        $("#mfa")[0].click();
        return;
      }
      console.log("signin.........");
      const usrname =JSON.stringify({username: result.firstname});
      localStorage.setItem('USERNAME', usrname);

      setTimeout(() => {
        setMessage("");
        window.location.href="/";
        setDisable(false);
      }, 3000);
      
    } else {
      setMessage(result.message);
      window.setTimeout(() => {
        setMessage("");
      }, 3000);
      setDisable(false);
    }        

  }

  const signinClose = () => {
    setUsername('');
    setPassword('')
    setMessage('')
    setDisable(false);
    window.location.href= "/";
  }

  return (
    <>
    <div className="modal fade" id="staticSigninBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabIndex={-1} aria-labelledby="staticSigninBackdropLabel" aria-hidden="true">
    <div className="modal-dialog modal-sm modal-dialog-centered">
      <div className="modal-content">
        <div className="modal-header bg-primary">
          <h1 className="modal-title fs-5" id="staticSigninBackdropLabel">Signin to your account</h1>
          <button onClick={signinClose} type="button" className="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div className="modal-body">
          <form onSubmit={signIn}>
           <div className="mb-3">
            <input type="text" value={username} onChange={e => setUsername(e.target.value)} className="form-control" id="signin" required placeholder="enter your username" autoComplete='off' disabled={disable}/>
           </div>            
           <div className="mb-3">
            <input type="password" value={password} onChange={e => setPassword(e.target.value)} className="form-control" id="pwd" required placeholder="enter your password" autoComplete='off' disabled={disable}/>
           </div>            
           <div className="mb-3">
            <button type='submit' className='btn btn-primary' disabled={disable}>signin</button>
            <button type='button' id="mfa" className={styles.hidemfabutton}  data-bs-toggle="modal" data-bs-target="#staticMFA"></button>

            </div>
          </form>
        </div>
        <div className="modal-footer">
            <div className='w-100 text-danger'>{message}</div>
        </div>
      </div>
    </div>
  </div>    
  <Mfa/>
  </>
  )
}
