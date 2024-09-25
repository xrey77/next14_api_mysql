'use client';

import React, { useEffect, useState } from 'react'
import $ from 'jquery/dist/jquery.slim';
import Image from 'next/image'
import qcode from '../public/images/qrcode.png';
import usrpic from '../public/users/pix.jpg';
import styles from '../page.module.css';
import {QRCodeCanvas} from 'qrcode.react';

export default function Profile({}) {
  const [firstname, setFirstname] = useState("");
  const [lastname, setLastname] = useState("");
  const [email, setEmail] = useState("");
  const [mobile, setMobile] = useState("");
  const [password, setPassword] = useState("");
  const [confpassword, setConfpassword] = useState("");
  const [message, setMessage] = useState("");
  const [userid, setUserid] = useState('');
  const [profilepic, setProfilepic] = useState('');
  const [qrcode, setQrcode] = useState('');
  const [userfile, setUserfile] = useState<File>();

  let user: any = [];

  const getFromLocalStorage = (key: string) => {
    if (!key || typeof window === 'undefined') {
        return ""
    }
    return localStorage.getItem(key)
  }

  const idno = { userid: getFromLocalStorage('USERID') ? JSON.parse(getFromLocalStorage('USERID') || '{}') : []};
  let userIdno: any = idno.userid.userid === undefined ? null : idno.userid.userid
  
  
  useEffect(() => {

    const fetchData = async (xid: any) => {
      setMessage("Pls wait, retrieving data..")
      const res = await fetch(`/api/users/${xid}`);
      res.json().then((data: any) => {
        setFirstname(data.rows[0].firstname);
        setLastname(data.rows[0].lastname);
        setEmail(data.rows[0].email);
        setMobile(data.rows[0].mobileno);
        if (data.rows[0].profilepic !== null) {
          setProfilepic(data.rows[0].profilepic);
        }
        if (data.rows[0].qrcode !== null) {
          setQrcode(data.rows[0].qrcode);
        }
      })
    }
  
    fetchData(userIdno);
    setMessage("");
  },[userIdno]);

  const updateProfile = async (e: any) => {
    e.preventDefault();

    if (password !== confpassword) {
      setMessage("New Password does not matched.");
      window.setTimeout(() => {
        setMessage("");
      }, 3000);
      return;
    }

    let response = await fetch('/api/users/profile/' + userIdno, {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        "lastname": lastname,
        "firstname": firstname,
        "mobileno": mobile})            
    }).catch((e: any) => {
      setMessage(e.message);
      return;
    });
    
    const result = await response?.json()
    if (result.status === 400) {
      setMessage(result.message);
    } else {
      setMessage(result.message);
    }
    setTimeout(() => {
      setMessage('');
    }, 3000);

  }

  const changePwd = () => {
    if ($('#chgPwd').is(":checked")) {    
      $('#mfacode').prop('checked', false);
      $("#qcode-info").hide();
      $("#qcode").hide();
      $("#cpwd").show();
    } 
    else {
      $("#cpwd").hide();
    }
  }

  const enableMFA = () => {
    if ($('#mfacode').is(":checked")) {    
      if ($('#chgPwd').is(":checked")) {    
        setPassword("");
        setConfpassword("");
        $('#chgPwd').prop('checked', false);
        $("#cpwd").hide();
      }
      $("#qcode").show();
      $("#qcode-info").show();
    } else {
      $("#qcode").hide();
      $("#qcode-info").hide();
    }
  }

  const changeProfilepic = async (e: any) => {  
    e.preventDefault();
    $("#userpic").attr('src',URL.createObjectURL(e.target.files[0]));
    const file = e.target.files[0];
    setUserfile(file);

    // var xid = localStorage.getItem('USERID')?.toString();
    const formdata = new FormData();
    formdata.append('userid', userIdno || '');
    formdata.append('myImage', file);
    await fetch(`/api/users/profilepic?id=${userIdno}`, {
      body: formdata,
      method: "post",
    }).then(async (result) => {

      let data = await result.json()
      if (data.status == 200) {
        setMessage(data.message);
      } else {
        setMessage(data.message);
      }
      window.setTimeout(() => {
        setMessage("");
        window.location.reload();
      }, 3000);  
      
    }).catch((e: any) => {
      setMessage(e.message);
      return;
    });  
  }

  const activateMFA = async () => {
    var fullname = firstname + " " + lastname;

    let response = await fetch('/api/users/activatemfa/' + userIdno, {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        "fullname": fullname, "isactivate": true})            
    }).catch((e: any) => {
      setMessage(e.message);
      return;
    });  
    const result = await response?.json()
    if (result.status == 200) {
      setMessage(result.message);
    } else {
      setMessage(result.message);
    }
    window.setTimeout(() => {
      setMessage("");
      window.location.reload();
    }, 3000);
  }

  const deactivateMFA = async () => {
    let response = await fetch('/api/users/activatemfa/' + userIdno, {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        "isactivate": false})            
    }).catch((e: any) => {
      setMessage(e.message);
      return;
    });
    const result = await response?.json()
    if (result.status == 200) {
      setMessage(result.message);
    } else {
      setMessage(result.message);
    }
    window.setTimeout(() => {
      setMessage("");
      window.location.reload();
    }, 3000);
  }

  const changePassword = async (event: any) => {
    event.preventDefault();
    if (password !== confpassword) {
      setMessage("Password does not matched.")
      setTimeout(() => {
          setMessage("");
      }, 3000);
    }
    let response = await fetch('/api/users/changepassword/' + userIdno, {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({"password": password})
    }).catch((e: any) => {
      setMessage(e.message);
      return;
    });
    
    const result = await response?.json()
    if (result.status === 400) {
      setMessage(result.message);
    } else {
      setMessage(result.message);
    }
    setTimeout(() => {
      setMessage('');
    }, 3000);

  }


  return (
    <div className="container">
          <main className={styles.cardprofiletop}>

      <div className={'card'}>
        <div className='card-header bg-info'>
             <strong>USER PROFILE ID NO.</strong>&nbsp; {userIdno}
        </div>
        <div className="card-body">

          <form onSubmit={updateProfile} encType='multipart/form-data' autoComplete='off' method='POST'>
            <div className='row'>
              <div className='col'>
                <div className="mb-3">
                  <label htmlFor="firstname" className="form-label">First Name</label>
                  <input type="text" className="form-control" value={firstname} onChange={e => setFirstname(e.target.value)}/>
                </div>            
                <div className="mb-3">
                  <label htmlFor="lastname" className="form-label">Last Name</label>
                  <input type="text" className="form-control" value={lastname} onChange={e => setLastname(e.target.value)}/>
                </div>            
              </div>
              <div className='col'>
                {
                  profilepic === '' ?
                  <Image id="userpic" className={styles.userprofile} src={usrpic} alt=''/>
                  :
                  <Image id="userpic" className={styles.userprofile} src={profilepic} alt=''/>
                }
                    <div className="mb-3 mt-2">
                      <input type="file" onChange={e => changeProfilepic(e)} className="form-control form-control-sm" id="profilepic"/>
                    </div>                                    
              </div>
            </div>

            <div className='row'>
              <div className='col'>
                <div className="mb-3">
                  <label htmlFor="email" className="form-label">Email Address</label>
                  <input type="email" readOnly className="form-control" value={email} onChange={e => setEmail(e.target.value)}/>
                </div>            
              </div>
              <div className='col'>
                <div className="mb-3">
                  <label htmlFor="mobile" className="form-label">Mobile No.</label>
                  <input type="text" className="form-control" value={mobile} onChange={e => setMobile(e.target.value)}/>
                </div>            
              </div>              
            </div>

            <button type='submit' className='btn btn-info mt-2 mb-2'>save profile</button>
            <hr/>
            {/* TAB CONTENT OPTIONS */}
            <nav>
              <div className="nav nav-tabs" id="nav-tab" role="tablist">
                <button className="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Change Password</button>
                <button className="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">2-Factor Authentication</button>
              </div>
            </nav>
            {/* Tab Content # 1 */}
            <div className="tab-content" id="nav-tabContent">
                <div className="tab-pane fade show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabIndex={0}>
                
                <div className='row mt-3'>
                <div className='col'>
                      <div id="cpwd"> 
                        <div className="mb-3">
                          <input type="text" className="form-control" value={password} onChange={e => setPassword(e.target.value)} placeholder='enter new password.'/>
                        </div>            
                      </div>
                      <button onClick={changePassword} type='button' className='btn btn-primary'>change password</button>

                 </div>
                 <div className='col'>
                      <div className="mb-3">
                          <input type="text" className="form-control" value={confpassword} onChange={e => setConfpassword(e.target.value)} placeholder='enter new password confirmation.'/>
                      </div>                 
                  </div>
              </div>
            </div>
              {/* Tab Content #2 */}
              <div className="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabIndex={0}>
                  
                  <div className='row'>
                      <div className='col'>

                        <p className='text-danger'><strong>REQUIREMENTS</strong></p>
                          <p>You need to install <strong>Google or Microsoft Authenticator</strong> in your Mobile Phone, once installed, click Enable Button below, and <strong>SCAN QR CODE</strong>, next time you login, another dialog window will appear, then enter the <strong>OTP CODE</strong> from your Mobile Phone in order for you to login.</p>
                          <div className='row'>
                            <div className='col-auto'>
                              <button onClick={activateMFA} type="button" className='btn btn-success'>Enable</button>
                            </div>
                            <div className='col-auto'>
                              <button onClick={deactivateMFA} type="button" className='btn btn-secondary'>Disable</button>                        
                            </div>
                          </div>


                      </div>
                      <div className='col'>
                        {
                          qrcode === '' ?
                            <Image className={styles.qrcode1} src={qcode} alt='' />
                        :
                        <div className={styles.qrcode2}>
                          <QRCodeCanvas value={qrcode} />
                        </div>
                        }

                      </div>
                  </div>
              </div>              
            </div>
          </form>    
        </div>
        <div className='card-footer text-danger'>{message}</div>
      </div>
      </main>    
      
    </div>
  )
}