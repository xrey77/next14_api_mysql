using Microsoft.AspNetCore.Mvc;
using core7_mongodb_angular14.Services;
using core7_mongodb_angular14.Helpers;
using core7_mongodb_angular14.Entities;
using Microsoft.Extensions.Options;
using Microsoft.AspNetCore.Authorization;

namespace core7_mongodb_angular14.Users
{
    [Authorize]    
    [ApiController]
    [Route("[controller]")]
    public class Getid : ControllerBase 
    {
        private readonly IUserService _usersService;
        private readonly ILogger<Getid> _logger;
        private readonly IConfiguration _configuration;  

        public Getid(
            IConfiguration configuration,
            IUserService usersService,
            ILogger<Getid> logger,
            IOptions<AppSettings> appSettings) {
                _configuration = configuration;                
                _usersService = usersService;
                _logger = logger;            
        }

        [HttpGet("/api/getuserbyid/{id}")]
        public ActionResult Getuserid(string id)
        {
            try {
                User user = _usersService.GetById(id);
                return Ok(new {
                    statuscode = 200,
                    message = "User found, please wait.",
                    user = user
                });
            } catch(Exception ex) {
                return NotFound(new {
                    statuscode = 404,
                    message = ex.Message
                });
            }
        }
    }   
}