import pool from "@/app/libs/mysql";
import { NextRequest, NextResponse } from "next/server";
import bcrypt from 'bcryptjs';
import { headers } from "next/headers";
import jwt from 'jsonwebtoken';
import getConfig from 'next/config'

export async function PATCH(req: NextRequest, ctx: any) {
    const data = await req.json();
    const {params} = ctx;

    const { serverRuntimeConfig } = getConfig()   
    let secret: any = serverRuntimeConfig.secret
    
    const headersList = headers();
    let token: any = headersList.get("authorization")?.split(' ')[1];

    try {
        jwt.verify(token, secret);
      } catch(err: any) {
        return NextResponse.json({
            status: 500,
            message: err.message,
        });

      }




    let hashPassword = bcrypt.hashSync(data.password, 10);
    try {
        let uid = parseInt(params.idNo,10);
        const db = await pool.getConnection()
        await db.query('UPDATE account SET password = ? WHERE id = ?', [hashPassword, uid]);
        db.release()
            return NextResponse.json({
                status: 200,
                message: "User account password has been changed."
            });    
    
    } catch (error) {
        return NextResponse.json({
            error: error
        }, { status: 500})
    }

}