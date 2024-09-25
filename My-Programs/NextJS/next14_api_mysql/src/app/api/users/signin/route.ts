import { NextResponse, NextRequest } from "next/server";
import pool from "@/app/libs/mysql";
import bcrypt from 'bcryptjs';
import getConfig from 'next/config'
import jwt from 'jsonwebtoken';

export async function POST(req: NextRequest) {
    const data = await req.json()
    const { serverRuntimeConfig } = getConfig()    
    let user = [
        data.username,
        data.password
    ];
    const pword = data.password;

    try {
        const db = await pool.getConnection()
        const [userName] = await db.query('SELECT * FROM account WHERE username = ?',[data.username]);
        db.release()        

        if (userName[0]) {
            
            let token = jwt.sign({ email: userName[0].email, id: userName[0].id != null ? userName[0].id : "" }, serverRuntimeConfig.secret, {expiresIn: '8h'});

            const passwordValid = await bcrypt.compare(pword,  userName[0].password != null ? userName[0].password : "")
            if (!passwordValid) {
                return NextResponse.json({
                    status: 400,
                    message: "Invalid password."
                });    
            } else {



                return NextResponse.json({
                    status: 200,
                    message: "Signin successfull, please wait.",
                    id: userName[0].id,
                    firstname: userName[0].firstname,
                    lastname: userName[0].lastname,
                    email: userName[0].email,
                    userpic: userName[0].profilepic,
                    qrcode: userName[0].qrcode,
                    token: token
                });
    
            }



        } else {

            return NextResponse.json({
                status: 400,
                message: "Username does not exists."
            });

        };


    
    } catch (error) {
        return NextResponse.json({
            error: error
        }, { status: 500})
    }

}


