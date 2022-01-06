package com.sbmvc.springbootmvc.services;

import java.util.List;
import java.util.stream.Collectors;

import org.modelmapper.ModelMapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.sbmvc.springbootmvc.entities.User;
import com.sbmvc.springbootmvc.models.dto.UserDTO;
import com.sbmvc.springbootmvc.repositories.UserRepository;

@Service
public class UserService {

	@Autowired
	private UserRepository 	userRepository;
	
    @Autowired
    private ModelMapper modelMapper;
	
	
    <S, T> List<T> mapList(List<S> source, Class<T> targetClass) {
        return source
          .stream()
          .map(element -> modelMapper.map(element, targetClass))
          .collect(Collectors.toList());
    }    
    
    
	public UserDTO createUser(UserDTO user) {
    	User userdto = mapToEntity(user);
    	User newUser = userRepository.save(userdto);
    	UserDTO userResponse = mapToDTO(newUser);
    	return userResponse;
	}
	
	
    public User getUserName(String username) {
    	return userRepository.getUserByUsername(username);
    }
    
    public User getUserEmail(String emailadd) {
    	return userRepository.getUserEmailadd(emailadd);
    }
	
	   private UserDTO mapToDTO(User user) {
	    	UserDTO userDto = modelMapper.map(user, UserDTO.class);
	    	return userDto;
	    }
	    
	    private User mapToEntity(UserDTO userDto) {
	    	User user = modelMapper.map(userDto, User.class);
	    	return user;
	    }
	 	
}
