package com.sbmvc.springbootmvc.entities;

import java.util.Date;
import javax.persistence.*;

import org.hibernate.annotations.CreationTimestamp;
import org.springframework.web.multipart.MultipartFile;

@Entity
@Table(name = "users")
public class User {
	
	private static int EXPIRATION = 60 * 24;
	
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private int id;
    
    @Column(name="username")
    private String username;
    
    @Column(name="password")
    private String password;
    
    @Column(name="active")
    private boolean active;
    
    @Column(name="roles")
    private String roles;
    
    @Column(name="fullname")
    private String fullname;
    
    @Column(name="emailadd")
    private String emailadd;
    
    @Column(name="mobileno")
    private String mobileno;
    
    @Column(name="picture")
    private String picture;
    
    @Column(name="expirydate", updatable=false)
    private Date expirydate;    
    
    @Column(name="verificationcode", updatable=false)
    private String verficationcode;
    
	@Transient
	private MultipartFile userpicture;	
	
	@Transient
    private String confirmpassword;

//    @Column(name="created_at" ,columnDefinition="TIMESTAMP DEFAULT CURRENT_TIMESTAMP")
	@CreationTimestamp
	@Temporal(TemporalType.TIMESTAMP)	
    @Column(name="created_at")
    private Date created_at;
	
    @Column(name="updated_at", updatable=false)
    private Date updated_at;
    
	
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


	public String getVerficationcode() {
		return verficationcode;
	}

	public void setVerficationcode(String verficationcode) {
		this.verficationcode = verficationcode;
	}

	public Date getExpirydate() {
		return expirydate;
	}

	public void setExpirydate(Date expirydate) {
		this.expirydate = expirydate;
	}

	public static int getExpiration() {
		return EXPIRATION;
	}

	public static void setExpiration(int expiration) {
		EXPIRATION = expiration;
	}

	
}