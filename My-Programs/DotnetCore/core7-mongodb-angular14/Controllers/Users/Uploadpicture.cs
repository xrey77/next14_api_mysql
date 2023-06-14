using core7_mongodb_angular14.Helpers;
using core7_mongodb_angular14.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Options;

namespace core7_mongodb_angular14.Controllers.Users
{
    [ApiController]
    [Route("[controller]")]    
    public class Uploadpicture : ControllerBase {

        private readonly IUserService _usersService;
        private readonly ILogger<Uploadpicture> _logger;
        private readonly IConfiguration _configuration;  

        public Uploadpicture(
            IConfiguration configuration,
            IUserService usersService,
            ILogger<Uploadpicture> logger,
            IOptions<AppSettings> appSettings) {
                _configuration = configuration;                
                _usersService = usersService;
                _logger = logger;            
        }

        [HttpPost("/api/uploadpicture")]
        public IActionResult uploadPicture([FromForm]UploadfileModel model) {
                if (model.Profilepic.FileName != null)
                {
                    try
                    {
                        string ext= Path.GetExtension(model.Profilepic.FileName);

                        var folderName = Path.Combine("Resources", "users/");
                        var pathToSave = Path.Combine(Directory.GetCurrentDirectory(), folderName);

                        var newFilename =pathToSave + "00" + model.Id + ".jpg";

                        using var image = SixLabors.ImageSharp.Image.Load(model.Profilepic.OpenReadStream());
                        image.Mutate(x => x.Resize(100, 100));
                        image.Save(newFilename);

                        if (model.Profilepic is not null)
                        {
                            string newfile = "http://localhost:5144/resources/users/00"+model.Id+".jpg";
                            _usersService.UpdatePicture(model.Id, newfile);                            
                        }
                        return Ok(new { statuscode = 200, message = "Profile Picture has been update."});                        
                    }
                    catch (Exception ex)
                    {
                        return Ok(new {statuscode = 200, message =ex.Message});
                    }
                }
                return Ok(new { statuscode = 404, message = "Profile Picture not found."});

        }        

    }
}