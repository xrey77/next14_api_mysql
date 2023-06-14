using core7_mongodb_angular14.Entities;
using core7_mongodb_angular14.Models;
using core7_mongodb_angular14.Services;
using Microsoft.AspNetCore.Mvc;
using core7_mongodb_angular14.Helpers;
using System.IdentityModel.Tokens.Jwt;
using System.Text;
using Microsoft.IdentityModel.Tokens;
using System.Security.Claims;

namespace core7_mongodb_angular14.Controllers.Auth
{
    [ApiController]
    [Route("[controller]")]
    public class Signin : ControllerBase 
    {
        private readonly IAuthService _authService;
        private readonly ILogger<Signin> _logger;
        private readonly IConfiguration _configuration;  

        public Signin(
            IConfiguration configuration,
            IAuthService authService,
            ILogger<Signin> logger) 
        {
            _configuration = configuration;
            _authService = authService;            
            _logger = logger;            
        }

        [HttpPost("/signin")]
        public IActionResult signin(UserLogin model) 
        {
            try 
            {
                User user = _authService.SigninUser(model.Username, model.Password);
                if (user is not null) {
                    if (!BCrypt.Net.BCrypt.Verify(model.Password, user.Password)) {
                        return Ok(new {statuscode = 404, message = "Incorrect Password."});
                    }

                    if(user.Isactivated == 0) {
                        return Ok(new {statuscode = 404,message = "Please activate your account, check your email inbox."});
                    } else if (user.Isblocked == 1) {
                        return Ok(new {statuscode = 404,message = "Your account has been blocked, pls. contact Web Master."});
                    }
                }

                var tokenHandler = new JwtSecurityTokenHandler();
                var xkey = _configuration["AppSettings:Secret"];
                var key = Encoding.ASCII.GetBytes(xkey);

                var tokenDescriptor = new SecurityTokenDescriptor
                {
                    Subject = new ClaimsIdentity(new Claim[]
                    {
                        new Claim(ClaimTypes.Name, user.Id.ToString())
                    }),
                    Expires = DateTime.UtcNow.AddDays(7),
                    SigningCredentials = new SigningCredentials(new SymmetricSecurityKey(key), SecurityAlgorithms.HmacSha256Signature)
                };
                var token = tokenHandler.CreateToken(tokenDescriptor);
                var tokenString = tokenHandler.WriteToken(token);

                return Ok(new { 
                    statuscode = 200, 
                    message="Signin successfull, please wait..",
                    id = user.Id,
                    lastname = user.Lastname,
                    firstname = user.Firstname,
                    email = user.Email,
                    username = user.Username,
                    roles = user.Roles,
                    isactivated = user.Isactivated,
                    isblocked = user.Isblocked,
                    profilepic = user.Profilepic,
                    token = tokenString
                    });
            } catch(Exception ex) {
                Console.WriteLine(ex.Message);
                return Ok(new {statuscode = 404, message = "Username not found, please register first."});
            }
        }
    }   
}