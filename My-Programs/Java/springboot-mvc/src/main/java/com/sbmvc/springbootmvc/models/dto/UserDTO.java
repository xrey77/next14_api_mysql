package com.sbmvc.springbootmvc.models.dto;

import java.sql.Timestamp;

import javax.persistence.Column;

public class UserDTO {

    private int id;
    private String username;
    private String password;
    private boolean active;    
    @Column(name="verificationcode")
    private String verificationcode;
    private String roles;
    private String fullname;
    private String emailadd;    
    private String mobileno;    
    private Timestamp updated_at;
    private boolean istwofactorenabled;
    private String qrcodeurl;
	private String picture;
        
	public String getPicture() {
		return picture;
	}
	public void setPicture(String picture) {
		this.picture = picture;
	}
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
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
	public String getVerificationcode() {
		return verificationcode;
	}
	public void setVerificationcode(String verificationcode) {
		this.verificationcode = verificationcode;
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
	public Timestamp getUpdated_at() {
		return updated_at;
	}
	public void setUpdated_at(Timestamp updated_at) {
		this.updated_at = updated_at;
	}
	public boolean isIstwofactorenabled() {
		return istwofactorenabled;
	}
	public void setIstwofactorenabled(boolean istwofactorenabled) {
		this.istwofactorenabled = istwofactorenabled;
	}
	public String getQrcodeurl() {
		return qrcodeurl;
	}
	public void setQrcodeurl(String qrcodeurl) {
		this.qrcodeurl = qrcodeurl;
	}
		
}
