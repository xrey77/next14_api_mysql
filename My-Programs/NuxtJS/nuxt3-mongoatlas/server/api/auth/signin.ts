import { PrismaClient } from "@prisma/client";
import bcrypt from "bcryptjs";
import jwt, { Secret, JwtPayload } from 'jsonwebtoken';
const config = useRuntimeConfig();

export default defineEventHandler(async (event: any) => {
    const prisma = new PrismaClient();
    const req = await readBody(event);

    const usrname = req.username;
    const pword = req.password;

    try {
        const user = await prisma.user.findUnique({
          where: {
            username: usrname,
          },
        })
        if (!user?.username) {
          return { message: 'Username not found.' };
        }

          let token = jwt.sign({ email: user.email, _id: user.id != null ? user?.id : "" }, config.public.secret, {expiresIn: '55s'});
          const passwordValid = await bcrypt.compare(pword,  user?.password != null ? user?.password : "")
  
          if (!passwordValid) {
            return { message: 'Invalid Password.' };
          }
          
          return { 
            statuscode: 200,
            message: 'Successful login.', 
            id: user?.id,
            firstname: user?.firstname,
            lastname: user?.lastname,
            email: user?.email,
            username: user?.username,
            isactivated: user?.isactivated,
            isblocked: user?.isblocked,
            profilepic: user?.profilepic,
            qrcodeurl: user.qrcodeurl,
            token: token};
        
        } catch(e) {
          return { statuscode: 404, message: "Username not found, please register first."};
        }
});