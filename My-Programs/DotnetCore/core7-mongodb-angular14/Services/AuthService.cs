using MongoDB.Driver;
using core7_mongodb_angular14.Entities;
using Microsoft.Extensions.Options;
using core7_mongodb_angular14.Helpers;
using System.IdentityModel.Tokens.Jwt;
using System.Text;
using Microsoft.IdentityModel.Tokens;
using System.Security.Claims;

namespace core7_mongodb_angular14.Services
{
    public interface IAuthService {
        Task<User> SignupUser(User user, string password);
        User SigninUser(string usrname, string pwd);        
    }

    public class AuthService : IAuthService
    {
        private readonly MongoDBContext _context;
        private readonly AppSettings _appSettings;
         IConfiguration config = new ConfigurationBuilder()
        .AddJsonFile("appsettings.json")
        .AddEnvironmentVariables()
        .Build();


        public AuthService (MongoDBContext context, IOptions<AppSettings> appSettings) {
            _context = context;
            _appSettings = appSettings.Value;            
        }

        public async Task<User> SignupUser(User userdata, string passwd)
        {
            FilterDefinition<User> filterEmail = Builders<User>.Filter.Eq("Email", userdata.Email);
            List<User> usrmail = _context.Users.Find(filterEmail).ToList();
            if (usrmail.Count > 0) {
                throw new AppException("Email Address was already taken...");
            } else {
                FilterDefinition<User> filterUsername = Builders<User>.Filter.Eq("Username", userdata.Username);
                List<User> usrname = _context.Users.Find(filterUsername).ToList();
                if (usrname.Count > 0) {
                    throw new AppException("Username was already taken...");
                }
            }

            var tokenHandler = new JwtSecurityTokenHandler();
            var xkey = config["AppSettings:Secret"];
            var key = Encoding.ASCII.GetBytes(xkey);

            // CREATE SECRET KEY FOR USER TOKEN===============
            var tokenDescriptor = new SecurityTokenDescriptor
            {
                Subject = new ClaimsIdentity(new Claim[]
                {
                    new Claim(ClaimTypes.Name, userdata.Email)
                }),
                // Expires = DateTime.UtcNow.AddDays(7),
                Expires = DateTime.UtcNow.AddHours(4),
                SigningCredentials = new SigningCredentials(new SymmetricSecurityKey(key), SecurityAlgorithms.HmacSha256Signature)
            };
            var secret = tokenHandler.CreateToken(tokenDescriptor);
            var secretkey = tokenHandler.WriteToken(secret);
            userdata.Secretkey = secretkey.ToUpper();             
            userdata.Password = BCrypt.Net.BCrypt.HashPassword(passwd);
            userdata.Profilepic = "http://localhost:5144/resources/users/pix.png";
            userdata.Roles="USER";
            await _context.Users.InsertOneAsync(userdata);
            return null;
        }

        public User SigninUser(string usrname, string pwd)
        {
            try {
                FilterDefinition<User> filterUsername = Builders<User>.Filter.Eq("Username",usrname);
                var usr = _context.Users.Find(filterUsername);
                User res = usr.FirstOrDefault();
                return res;
            } catch(Exception) {
                throw new AppException("Username not found, please register first...");
            }
        }
    }

}