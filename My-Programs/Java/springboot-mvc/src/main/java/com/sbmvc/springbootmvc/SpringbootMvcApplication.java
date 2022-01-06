package com.sbmvc.springbootmvc;


import org.modelmapper.ModelMapper;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.Bean;
//import org.springframework.data.jpa.repository.config.EnableJpaRepositories;

//import com.sbmvc.springbootmvc.repositories.UserRepository;


@SpringBootApplication
//@EnableJpaRepositories(basePackageClasses = UserRepository.class)
public class SpringbootMvcApplication {

	@Bean
	public ModelMapper modelMapper() {
	    return new ModelMapper();
	}			
	
	public static void main(String[] args) {
				
		SpringApplication.run(SpringbootMvcApplication.class, args);
	}

}
