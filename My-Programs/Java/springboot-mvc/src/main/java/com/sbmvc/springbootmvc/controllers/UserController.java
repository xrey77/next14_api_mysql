package com.sbmvc.springbootmvc.controllers;

import java.util.HashMap;
import java.util.Map;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.MediaType;
import org.springframework.security.crypto.password.PasswordEncoder;
//import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
//import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import com.sbmvc.springbootmvc.entities.User;
import com.sbmvc.springbootmvc.models.UserModel;
import com.sbmvc.springbootmvc.models.dto.LoginDTO;
import com.sbmvc.springbootmvc.models.dto.UserDTO;
import com.sbmvc.springbootmvc.services.UserService;

@RestController
public class UserController {

		@Autowired
		private UserService userService;
		
		@Autowired
		private PasswordEncoder passwordEncoder;	
		
		
	   @PostMapping(path = "/signup", consumes = {MediaType.APPLICATION_FORM_URLENCODED_VALUE})
	   public Map<String, String> signup(UserDTO user) {
		    HashMap<String, String> map = new HashMap<>();

		    
		    User existEmail = userService.getUserEmail(user.getEmailadd());
		    if (existEmail != null) {
			    map.put("statuscode", "400");		  		
			    map.put("message", "Email Address is taken.");
			    return map;
		    }
		  	
		  	User existUsername = userService.getUserName(user.getUsername());
		  	if (existUsername != null) {
			    map.put("statuscode", "400");		  		
			    map.put("message", "Username is taken.");
			    return map;
		  	}
		    
		  	if (user.getPassword() != null) {

		   	     user.setPassword(passwordEncoder.encode(user.getPassword()));		   	    
		         userService.createUser(user);
		  	}
		     map.put("statuscode", "200");		  		
			 map.put("message", "You have registered successfully.");
	         return map;		  	
	   }
	   
	   @PostMapping(path = "/signin", consumes = {MediaType.APPLICATION_FORM_URLENCODED_VALUE})
	   public Map<String, String> signin(LoginDTO user, HttpSession session) {
		    HashMap<String, String> map = new HashMap<>();
	          User xuser = userService.getUserName(user.getUsername());          
	          if (xuser != null) {
	        	  if (passwordEncoder.matches(user.getPassword(), xuser.getPassword())) {
	        			session.setAttribute("USERNAME", user.getUsername());
	    	  		    map.put("statuscode", "200");
	    	  		    map.put("message", "Password Success.");		   

	        	  }	else {
	  	  		    map.put("statuscode", "400");
	  	  		    map.put("message", "Wrong Password.");		   
				    return map;	        	  
	        		  
	        	  }
	          }	else {
	  		    map.put("statuscode", "400");
	  		    map.put("message", "Username does not exists, please register.");		   
			    return map;	        	  
	          }
	  		    return map;
	  		    
		    		    
	   }
	   
	   
	   
}
