import { NextResponse, NextRequest } from "next/server";
import pool from "@/app/libs/mysql";
import bcrypt from 'bcryptjs';

export async function GET() {
    try {
        const db = await pool.getConnection()
        const [rows] = await db.query('SELECT * FROM account');
        db.release()
        
        return NextResponse.json({
            status: 200,
            message: "New products has been added.",
            rows
        });
    
    } catch (error) {
        return NextResponse.json({
            error: error
        }, { status: 500})
    }

}

export async function POST(req: NextRequest) {
    const data = await req.json()
    let user = [
        data.firstname,
        data.lastname,        
        data.email,
        data.mobileno,
        data.username,
        bcrypt.hashSync(data.password, 10),
        0
    ];

    try {
        const db = await pool.getConnection()
        const [userEmail] = await db.query('SELECT * FROM account WHERE email = ?',[data.email]);
        db.release()        

        if (userEmail[0]) {

            return NextResponse.json({
                status: 400,
                message: "Email Address is already taken."
            });

        } else {

            const [userUsername] = await db.query('SELECT * FROM account WHERE username = ?',[data.username]);
            db.release()        
            if (userUsername[0]) {
                return NextResponse.json({
                    status: 400,
                    message: "Username is already taken."
                });    
            } else {

                const [rows] = await db.query('INSERT INTO account(firstname,lastname,email,mobileno,username,password,isadmin) VALUE(?,?,?,?,?,?,?)',user);
                db.release()        
                return NextResponse.json({
                    status: 200,
                    message: "New user has been added.",
                    data
                });

            }

        };


    
    } catch (error) {
        return NextResponse.json({
            error: error
        }, { status: 500})
    }

}


