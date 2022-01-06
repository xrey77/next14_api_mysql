package com.sbmvc.springbootmvc.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.builders.WebSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.annotation.web.configuration.WebSecurityConfigurerAdapter;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.util.AntPathMatcher;
import org.springframework.web.servlet.config.annotation.PathMatchConfigurer;


@Configuration
@EnableWebSecurity
@ComponentScan("com.sbmvc.springbootmvc")
public class WebSecurityConfig extends WebSecurityConfigurerAdapter {

    public void configurePathMatch(PathMatchConfigurer configurer) {
        AntPathMatcher matcher = new AntPathMatcher();
        matcher.setCaseSensitive(true);
        configurer.setPathMatcher(matcher);
    }	
		    
    @Bean
    public BCryptPasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder();
    }
    
    
	@Override
	public void configure(WebSecurity web) throws Exception {
		web.ignoring().antMatchers("/resources/**");
	}	

	@Bean
	public PasswordEncoder encoder() {
	    return new BCryptPasswordEncoder();
	}	
	
	@Override
	protected void configure(HttpSecurity http) throws Exception {
				
	      http.authorizeRequests().antMatchers("/admin","signout").hasAnyAuthority("ROLE_USER", "ROLE_ADMIN")
		      .and()
		      .authorizeRequests().antMatchers("/","/home","/signup","/css/**","/js/**","/images/**").anonymous()
		      .and()           
          .csrf()	
          .disable();	  

	}
	
}
