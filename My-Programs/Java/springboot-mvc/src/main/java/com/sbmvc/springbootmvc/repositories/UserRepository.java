package com.sbmvc.springbootmvc.repositories;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import com.sbmvc.springbootmvc.entities.User;

public interface UserRepository  extends JpaRepository<User, Integer> {

    Optional<User> findByUsername(String username);
    
    @Query("SELECT u FROM User u WHERE u.username = :username")
    public User getUserByUsername(@Param("username") String username);
    
    @Query("SELECT u FROM User u WHERE u.emailadd = :emailadd")
    public User getUserEmailadd(@Param("emailadd") String emailadd);
    
    @Query("UPDATE User u SET u.active = true WHERE u.id = ?1")
    @Modifying
    public void active(Integer id);
    
    @Query("SELECT u FROM User u WHERE u.verficationcode = ?1")
    public User findByVerificationCode(String code);
	
	
}
