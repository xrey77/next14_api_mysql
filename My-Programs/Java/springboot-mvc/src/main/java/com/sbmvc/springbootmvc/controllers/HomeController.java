package com.sbmvc.springbootmvc.controllers;

import java.io.IOException;

import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.servlet.ModelAndView;


@Controller
public class HomeController {

		
	   @GetMapping("/home")
	   public ModelAndView home(ModelAndView model) {
		   model.setViewName("home");		   
		   return model;
	   }
	
	   @GetMapping("/aboutus")
	   public ModelAndView aboutus(ModelAndView model) {
		   model.setViewName("aboutus");
		   return model;
	   }

	   @GetMapping("/contactus")
	   public ModelAndView contactus(ModelAndView model) {
		   model.setViewName("contactus");
		   return model;
	   }

	   @GetMapping("/profile")
	   public ModelAndView profile(ModelAndView model) {
		   model.setViewName("profile");
		   return model;
	   }

	   //	   public String logout(HttpSession session, HttpServletResponse httpResponse) throws IOException {

	   @GetMapping("/signout")
	   public String logout(HttpSession session) {
		    session.removeAttribute("USERNAME");
  		    session.invalidate();
  		    return "redirect:home";
//  		    httpResponse.sendRedirect("/");
//  	        return null;
	   }
	   
}
