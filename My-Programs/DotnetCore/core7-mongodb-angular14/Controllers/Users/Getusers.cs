using core7_mongodb_angular14.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Options;
using core7_mongodb_angular14.Helpers;
using core7_mongodb_angular14.Entities;
using Microsoft.AspNetCore.Authorization;

namespace core7_mongodb_angular14.Controllers.Users
{
    [Authorize]
    [ApiController]
    [Route("[controller]")]
    public class Getusers : ControllerBase {

        private readonly IUserService _usersService;
        private readonly ILogger<Getusers> _logger;
        private readonly IConfiguration _configuration;  

        public Getusers(
            IConfiguration configuration,
            IUserService usersService,
            ILogger<Getusers> logger,
            IOptions<AppSettings> appSettings) {
                _configuration = configuration;                
                _usersService = usersService;
                _logger = logger;            
        }

        [HttpGet("/api/getallusers")]        
        public IActionResult getusers() {
            try {
                var users = _usersService.GetAll();
                return Ok(users);
            } catch(Exception ex) {
                return Ok(new { statuscode = 404, message = ex.Message});
            }
        }
    }    
}