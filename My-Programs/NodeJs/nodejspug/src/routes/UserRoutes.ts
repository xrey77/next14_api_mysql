import {Router, Request, Response} from 'express';
const router = Router();

router.get("/", (req: Request, res: Response) => {
       res.render('home');
});

router.get("/aboutus", (req: Request, res: Response) => {
    res.render('aboutus');
});

router.get("/services", (req: Request, res: Response) => {
    res.render('services');
});

router.get("/sst", (req: Request, res: Response) => {
    res.render('sst');
});

router.get("/ats", (req: Request, res: Response) => {
    res.render('ats');
});

router.get("/bsolutions", (req: Request, res: Response) => {
    res.render('bsolutions');
});

router.get("/contactus", (req: Request, res: Response) => {
    res.render('contactus');
});

router.get("/register", (req: Request, res: Response) => {
    res.render('register');
});

router.get("/login", (req: Request, res: Response) => {
    res.render('login');
});

router.get("/forgot", (req: Request, res: Response) => {
    res.render('forgot');
});

router.get("/mailtoken", (req: Request, res: Response) => {
    res.render('mailtoken');
});

router.get("/changepwd", (req: Request, res: Response) => {
    res.render('changepassword');
});



export default router;