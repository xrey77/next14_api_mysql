'use client'
import React, { useState } from 'react'

export default function Signup() {
  const [firstname, setFirstname] = useState('');
  const [lastname, setLastname] = useState('');
  const [emailadd, setEmailadd] = useState('');
  const [mobileno, setMobileno] = useState('');
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [message, setMessage] = useState('');

  const signUp = async (event: any) => {
    event.preventDefault()
    setMessage("Please wait..");
    let response = await fetch('/api/users/signup', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        "firstname": firstname,
        "lastname": lastname,
        "email": emailadd,
        "mobileno": mobileno,
        "username": username,
        "password": password})            
    }).catch((e: any) => {
      setMessage(e.message);
      return;
    });

    const result = await response?.json()
    if (result.status == 200) {
      setMessage(result.message)
      window.setTimeout(() => {
        setMessage("");
        window.location.href= "/";
      }, 3000);
    } else {
      setMessage(result.message)
      window.setTimeout(() => {
        setMessage("");
      }, 3000);
    }

  }

  const signupClose = () => {
    setFirstname('');
    setLastname('');
    setEmailadd('');
    setMobileno('');
    setUsername('');
    setPassword('');
    setMessage('');
    
    window.location.href="/";
  }

  return (
    <div className="modal fade" id="staticSignupBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabIndex={-1} aria-labelledby="staticSignupBackdropLabel" aria-hidden="true">
    <div className="modal-dialog modal-dialog-centered">
      <div className="modal-content">
        <div className="modal-header bg-info">
          <h1 className="modal-title fs-5" id="staticSignupBackdropLabel">Create Account</h1>
          <button onClick={signupClose} type="button" className="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div className="modal-body">
          <form onSubmit={signUp}>
            <div className='row'>
                <div className='col'>
                  <div className="mb-3">
                    <input type="text" value={firstname} onChange={e => setFirstname(e.target.value)} className="form-control" id="fname" required placeholder="enter your Firstname"/>
                  </div>            
                </div>
                <div className='col'>
                  <div className="mb-3">
                    <input type="text" value={lastname} onChange={e => setLastname(e.target.value)} className="form-control" id="lname" required placeholder="enter your Lastname"/>
                  </div>            
                </div>
            </div>
            
            <div className='row'>
                <div className='col'>
                  <div className="mb-3">
                    <input type="email" value={emailadd} onChange={e => setEmailadd(e.target.value)} className="form-control" id="mail" required placeholder="enter your Email Address"/>
                  </div>            
                </div>
                <div className='col'>
                  <div className="mb-3">
                    <input type="text" value={mobileno} onChange={e => setMobileno(e.target.value)} className="form-control" id="mobile" required placeholder="enter your Mobile No."/>
                  </div>            
                </div>
            </div>

            <div className='row'>
                <div className='col'>
                  <div className="mb-3">
                    <input type="text" value={username} onChange={e => setUsername(e.target.value)} className="form-control" id="usrname" required placeholder="enter your username"/>
                  </div>            
                </div>
                <div className='col'>
                  <div className="mb-3">
                    <input type="password" value={password} onChange={e => setPassword(e.target.value)} className="form-control" id="pword" required placeholder="enter your password"/>
                  </div>            
                </div>
            </div>


           <div className="mb-3">
            <button type='submit' className='btn btn-info text-white'>signup</button>
            </div>
          </form>
        </div>
        <div className="modal-footer">
            <div className='w-100 text-danger'>{message}</div>
        </div>
      </div>
    </div>
  </div>        
  )
}
