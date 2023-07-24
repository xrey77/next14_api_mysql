import { PrismaClient } from "@prisma/client";
import bcrypt from "bcryptjs";

export default defineEventHandler(async (event: any) => {
    const prisma = new PrismaClient();
    const req = await readBody(event);

    let fname = req.firstname;
    let lname = req.lastname;
    let email = req.email;
    let mobile = req.mobile;
    let usrname = req.username;
    let passwd = bcrypt.hashSync(req.password, 10);

    const umail = await prisma.user.findUnique({
        where: {
          email: email,
        },
      })

      if (umail !== null) {
        return { 
            statuscode: 201,
            message: 'Email Address is taken.'
        };           
      }


    const uname = await prisma.user.findUnique({
        where: {
          username: usrname,
        },
      })
      if (uname !== null) {
        return { 
            statuscode: 201,
            message: 'Username is taken.'
        };           
      }

    await prisma.user.create({
        data: {
            lastname: lname,
            firstname: fname,
            email: email,
            mobile: mobile,
            username: usrname,
            password: passwd,
            secretkey: "",
            qrcodeurl: "",
            profilepic: "/users/pix.png"
        }
    });
    
    return { 
         statuscode: 200,
         message: 'You have registered successfully, you may login now.'
     };


});