package com.sbmvc.springbootmvc.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.servlet.ModelAndView;

@Controller
public class ServicesController {

	   @GetMapping("/retails")
	   public ModelAndView retails(ModelAndView model) {
		   model.setViewName("retails");
		   return model;
	   }
	
	   @GetMapping("/cuttings")
	   public ModelAndView cuttings(ModelAndView model) {
		   model.setViewName("cuttings");
		   return model;
	   }

	   @GetMapping("/repairs")
	   public ModelAndView repairs(ModelAndView model) {
		   model.setViewName("repairs");
		   return model;
	   }
	   
}
