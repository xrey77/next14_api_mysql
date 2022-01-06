package com.sbmvc.springbootmvc.models;

import org.springframework.web.multipart.MultipartFile;
import java.util.Date;

public class UserModel {

    private String username;
    
    private String password;
    
    private boolean active;
    
    private String roles;
    
    private String fullname;
    
    private String emailadd;
    
    private String mobileno;
    
    private String picture;
    
    private Date expirydate;    
    
    private Date updated_ad;
    
    private String verficationcode;
    
	private MultipartFile userpicture;	
	
    private String confirmpassword;

	public String getUsername() {
		return username;
	}

	public void setUsername(String username) {
		this.username = username;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public boolean isActive() {
		return active;
	}

	public void setActive(boolean active) {
		this.active = active;
	}

	public String getRoles() {
		return roles;
	}

	public void setRoles(String roles) {
		this.roles = roles;
	}

	public String getFullname() {
		return fullname;
	}

	public void setFullname(String fullname) {
		this.fullname = fullname;
	}

	public String getEmailadd() {
		return emailadd;
	}

	public void setEmailadd(String emailadd) {
		this.emailadd = emailadd;
	}

	public String getMobileno() {
		return mobileno;
	}

	public void setMobileno(String mobileno) {
		this.mobileno = mobileno;
	}

	public String getPicture() {
		return picture;
	}

	public void setPicture(String picture) {
		this.picture = picture;
	}

	public Date getExpirydate() {
		return expirydate;
	}

	public void setExpirydate(Date expirydate) {
		this.expirydate = expirydate;
	}

	public String getVerficationcode() {
		return verficationcode;
	}

	public void setVerficationcode(String verficationcode) {
		this.verficationcode = verficationcode;
	}

	public MultipartFile getUserpicture() {
		return userpicture;
	}

	public void setUserpicture(MultipartFile userpicture) {
		this.userpicture = userpicture;
	}

	public String getConfirmpassword() {
		return confirmpassword;
	}

	public void setConfirmpassword(String confirmpassword) {
		this.confirmpassword = confirmpassword;
	}

	public Date getUpdated_ad() {
		return updated_ad;
	}

	public void setUpdated_ad(Date updated_ad) {
		this.updated_ad = updated_ad;
	}
	
	
}
