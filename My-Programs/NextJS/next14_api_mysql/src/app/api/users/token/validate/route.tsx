import { NextResponse, NextRequest } from "next/server";
import pool from "@/app/libs/mysql";
// import getConfig from 'next/config'
import speakeasy from'speakeasy';

export async function POST(req: NextRequest, res: NextResponse) {
        const data = await req.json()
    // const { serverRuntimeConfig } = getConfig()    
        let idno: any = parseInt(data.id, 10);        
        let tokenCode: any = parseInt(data.otpcode,10);
        // console.log("USER ID : " + idno);
        // console.log("OTPCODE : " + tokenCode);
        const db = await pool.getConnection()
        const [userName] = await db.query('SELECT * FROM account WHERE id = ?',[idno]);
        
        // console.log("SECRET KEY : " + userName[0].secretkey);

        let secretCode: any = userName[0].secretkey;
        let verified = speakeasy.totp.verify({
            secret: secretCode,
            encoding: 'base32',
            token: tokenCode,
            window: 1
          })
  
        if (verified) {
            return NextResponse.json({
                status: 200,
                message: 'Validation Successfull.',
                username: userName[0].username
            });    

        } else {
            return NextResponse.json({
                status: 404,
                message: 'Invalid OTP Code.'
            });        
        }



}