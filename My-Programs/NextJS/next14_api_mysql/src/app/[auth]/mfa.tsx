import React from 'react'
import { useState } from "react"

export default function Mfa() {
    const [otpcode, setOtpcode] = useState('');
    const [message, setMessage] = useState('');
    const [dizable, setDizable] = useState(false);
    
    const getFromLocalStorage = (key: string) => {
      if (!key || typeof window === 'undefined') {
          return ""
      }
      return localStorage.getItem(key)
    }
  
    const idno = { userid: getFromLocalStorage('USERID') ? JSON.parse(getFromLocalStorage('USERID') || '{}') : []};
    let userIdno: any = idno.userid.userid === undefined ? null : idno.userid.userid
  

    const closeMFA = () => {
        localStorage.clear();
        window.location.href="/";
    }

    const submitMFA = async (e: any) => {
        e.preventDefault();
        setDizable(true);
        setMessage('wait..validating OTP code.');
        let response = await fetch('/api/users/token/validate', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({
              "id": userIdno,
              "otpcode": otpcode}) 

          }).catch((e: any) => {
            setMessage(e.message);
            setDizable(false);
            return;
          });

          const result = await response?.json()          
          if (result.status === 200) {
              setMessage(result.message);
              const usrname =JSON.stringify({username: result.username});
              localStorage.setItem('USERNAME', usrname);
              setTimeout(() => {
                window.location.href="/";
              }, 3000);
              
          } else {

            setMessage(result.message);
            setTimeout(() => {
              setMessage("");
            }, 3000);
            setDizable(false);
          }

    }


    return (
    <div className="modal fade" id="staticMFA" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticMFALabel" aria-hidden="true">
    <div className="modal-dialog modal-sm modal-dialog-centered">
        <div className="modal-content">
        <div className="modal-header bg-warning">
            <h1 className="modal-title fs-5 text-white" id="staticMFALabel">2-Factor Authenticator</h1>
            <button onClick={closeMFA} type="button" className="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div className="modal-body">
            <form onSubmit={submitMFA}>
                <div className="mb-3">
                    <input disabled={dizable} type="text" required className="form-control" value={otpcode} onChange={e => setOtpcode(e.target.value)} autoComplete='off' placeholder="enter OTP Code"/>
                </div>            

                <button disabled={dizable} type="submit" className="btn btn-warning">submit</button>
            </form>
        </div>
        <div className="modal-footer">
            <div id="MfaMsg" className="w-100 text-left text-danger">{message}</div>
        </div>
        </div>
    </div>
    </div>
    )
}


