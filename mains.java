package gossip_per_day;

import java.applet.Applet;
import java.awt.Button;
import java.awt.Choice;
import java.awt.Color;
import java.awt.Event;
import java.awt.Font;
import java.awt.Graphics;
import java.awt.Graphics2D;
import java.awt.Image;
import java.awt.Label;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.awt.event.MouseMotionListener;
import java.awt.geom.AffineTransform;
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.io.StreamCorruptedException;

import javax.swing.JApplet;

import Statistics.cluster;


public class mains extends Applet 
implements MouseListener, ActionListener{
//Global Variables........
	public static node nodes[] =new node[5000];					//The max node no. is 5000 
	public static String locations[]={"Asgard", "Agartha", "Avalon", "Cockaigne", "Camelot", "Hawaiki", "Meropis", "Mu", "Tartarus", "Niflheim", "Niflhel", "Utopia", "Valhalla", "Alfheim", "Hyperborea", "Heaven", "Hell", "Jotunheim", "Lemuria"};
	public static int no_loc=19;			//No of locations
	Font font1 = new Font("Arial", Font.BOLD, 15);
	public Choice choice,ch2;
	public Label l;
	
	int tables,X,Y,data[][][],reducto,which=10,which2=10;
	String date[],header;
	String X_axis[]={"Asgard", "Agartha", "Avalon", "Cockaigne", "Camelot", "Hawaiki", "Meropis", "Mu", "Tartarus", "Niflheim", "Niflhel", "Utopia", "Valhalla", "Alfheim", "Hyperborea", "Heaven", "Hell", "Jotunheim", "Lemuria"};
	String Y_axis[]={"Asgard", "Agartha", "Avalon", "Cockaigne", "Camelot", "Hawaiki", "Meropis", "Mu", "Tartarus", "Niflheim", "Niflhel", "Utopia", "Valhalla", "Alfheim", "Hyperborea", "Heaven", "Hell", "Jotunheim", "Lemuria"};
	String Toptopics[][];
	private boolean laidOut = false;
	
	int highlight_j,highlight_i,show, play=0;
	 Image backbuffer;
	 Graphics backg;
//Global Variables end..............................................................................................................
	
	public void init(){
		choice= new Choice();
		ch2=new Choice();
		try {readdata("gossip.csv");} catch (IOException e) {}	//Filling in the data
		
		Button b=new Button("Play");
		b.addActionListener(this);
		add(b);
		
		backbuffer = createImage( 1300, 700 );
	    backg = backbuffer.getGraphics();
	    backg.setColor( Color.white );
	    addMouseListener( this );
	}	//Initialization Over

public void animate(){
	for (int i=0;i<252;i++){
		which++;
		repaint();
		choice.select(which);
		try {
			Thread.sleep(80);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		if (which>250) which=0;
	}
}
public boolean action(Event evt, Object whichAction)
	{if ((evt.target instanceof Choice)){   
	 	
		Choice whichChoice = (Choice) evt.target;
	 	if (whichChoice == choice){
	 		which=choice.getSelectedIndex();
	 		//if (which==1) animate();
	 		repaint();
	 	}
	  
	 	return false;
		}
	return false;
	}

/**
 * It paints a very bad thing!! All the nodes... and edges
 * @param g
 */
public void paint_whole(Graphics g){
	node temp;
	int x=1251, y=681;		//Two good primes nos
	int z=1;
	
	for (int i=0; i< 5000; i++){
		temp=nodes[i];
		if(temp != null) {
			//System.out.println("Drawing node "+i+" At "+(15* i)%x+" , "+ (10+15*i)%y);
			g.fillOval((15* i)%x *z, (10+15*i)%y *z , 5, 5);	
			
			for (int j=0;j<temp.no_edges;j++){
				g.drawLine((15* i)%x *z, (10+15*i)%y *z,(15* temp.edges[j])%x *z, (10+15*temp.edges[j])%y *z);
			}
		}
	}
	System.out.println("Done kala");
	for (int i=0; i< 5000; i++){
		temp=nodes[i];
		if(temp != null ) {
			if (temp.location.equals("Asgard")){
				System.out.println("Colouring RED");
				g.setColor(Color.RED);
			
				g.fillOval((15* i)%x *z, (10+15*i)%y *z , 5, 5);
			
				for (int j=0;j<temp.no_edges;j++){
					if (!nodes[temp.edges[j]].location.equals("Asgard"))
					g.drawLine((15* i)%x *z, (10+15*i)%y *z,(15* temp.edges[j])%x *z, (10+15*temp.edges[j])%y *z);
					
					}
			}
		}
	}
}

/**
 * Paints the graphical thing...
 * @param date_index
 * @param g
 */
public void paint_table(Graphics g, int date_index){

	Font f1=g.getFont();
	g.setFont(font1);
	g.drawString("Date:  ", 920, 115);
	g.setFont(f1);
	
	f1=g.getFont();
	g.setFont(font1);
	g.drawString(header, 20, 60);
	g.setFont(f1);
	
//---------------------------
	//Draw axis first....
	g.drawLine(150, 750, 150, 100);
	g.drawLine(150, 100, 800, 100);
	
	Graphics2D g1 = (Graphics2D) g; 		// Type casting jugad...Interesting!!!
	AffineTransform at = new AffineTransform();
		at.setToRotation(-Math.PI / 2.0);
		g1.setTransform(at);
		
		for (int i=0;i<19;i++){
			g1.drawString(locations[i], -90, 140+(i+1)*30);
		}
		
		at.setToRotation(0);
		g1.setTransform(at); //Rotation Back to Normal
	
//Plotting data points....
	for (int i=0; i<19; i++){
		g.drawString(locations[i], 50 , 85 + (i+1)*30);
		for (int j=0; j<19; j++){
			g.fillOval((150 + (j+1) * 30 -15)-data[date_index][i][j]/2 , 100 + (i+1) * 30 -15 - data[date_index][i][j]/2, data[date_index][i][j], data[date_index][i][j]);
		}
	}

}//End of print_table

public void paint(Graphics g){
	
	while(!laidOut){
		choice.setLocation(1000, 100);
		choice.setSize(100, 20);
		ch2.setLocation(1130, 100);
		laidOut =true;
	}
	
	if (show==1){
		g.setColor(Color.YELLOW);
		g.fillRect(150, 100 +30*highlight_i+10, 600, 10);
		g.fillRect(150+30*highlight_j+10, 100 , 10, 600);		
		g.setColor(Color.BLACK);
		
	}
	
paint_table(g,which);
	
	if (show==1){
		g.setColor(Color.RED);
		int i=highlight_i;
		int j=highlight_j;
		g.fillOval((150 + j * 30 +15)-data[which][i][j]/2 , 100 + i * 30 +15 - data[which][i][j]/2, data[which][i][j], data[which][i][j]);
		g.setColor(Color.BLACK);
		
		int aapas_mein=0, bahar_ke=0;
		for (i=0;i<19;i++){
			bahar_ke+=data[which][highlight_i][i];
			bahar_ke+=data[which][i][highlight_j];
		}
		aapas_mein=data[which][highlight_i][highlight_j];
		bahar_ke-=2*aapas_mein;
		float corr =(float) aapas_mein*100/bahar_ke;
		Font f1=g.getFont();
		g.setFont(font1);
		g.drawString(locations[highlight_i] + " - " +locations[highlight_j], 900, 335);
		g.drawString("Correlation coeff  = ", 860, 350);
		g.drawString(Float.toString(corr)+" %", 1000, 350);
		g.drawString("Communications history: ", 860, 400);
		g.setFont(f1);
		
		history(g);
		//show=0;
	}
	Font f1=g.getFont();
	g.setFont(font1);
	g.drawString("Top Topics Of the day: ", 900, 200);
	g.drawString(Toptopics[which][0], 950, 230);
	g.drawString(Toptopics[which][1], 950, 260);
	g.drawString(Toptopics[which][2], 950, 290);
	g.setFont(f1);
	
	if (play == 1){
		which++;
		if (which == which2) play=0;
		choice.select(which);
		try {
			Thread.sleep(80);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		repaint();
	}
	}//End of paint

public void history(Graphics g){
	//Make axis...
	int X=800,Y=600;
	g.drawLine(X, Y, X, Y-180);
	g.drawLine(X, Y, X+400, Y);
	//g.drawLine(X-5, Y-20, X+5, Y-20);
	g.drawLine(X-5, Y-40, X+5, Y-40);
	//g.drawLine(X-5, Y-60, X+5, Y-60);
	g.drawLine(X-5, Y-80, X+5, Y-80);
	g.drawLine(X-5, Y-120, X+5, Y-120);
	g.drawString("200", X-30, Y-35);
	g.drawString("400", X-30, Y-75);
	g.drawString("600", X-30, Y-115);
	
	int temp=which;
	
	for (int i=7;i>0 && temp >=0;i--){
		g.setColor(Color.BLUE);
		g.fillRect(X + 5 + 55 * (i-1) , Y-2*(data[temp][highlight_i][highlight_j]) , 50, 2*data[temp][highlight_i][highlight_j]);
		g.setColor(Color.BLACK);
		g.drawString(date[temp], X +15 + 55 * (i-1), Y+20);
		temp--;
	}
	
}

/**
 * Reads a csv file (comm. wali and putsm the data)
 * @param filename
 * @throws IOException
 */
public void readdata(String filename) throws IOException{
	//System.out.println(filename);
	
	FileReader f=null;
	try {f = new FileReader(filename);} catch (FileNotFoundException e) {}			//Linking f to file.
	BufferedReader reader = new BufferedReader(f);			//Linking a buffer to f.
//------------------------------------------------------------
	
	String s=null;
	header=reader.readLine();	//Line 1...Header
	s=reader.readLine();	//Line 2...No. of tables
	tables = Integer.parseInt(s);
	
	data=new int[tables][20][20];
	date=new String[tables];
	Toptopics=new String[tables][3];
	
	for (int outermost=0; outermost<tables; outermost++){	
		date[outermost]=new String(reader.readLine());	//Line 1...date
		reader.readLine();
		try {s=reader.readLine();} catch (IOException e) {}					//Line 2...reduction coeff.
		reducto=Integer.parseInt(s);
	
		for (int i=0; i<19 ;i++){
			s=reader.readLine();
			String s1[]=s.split(",");
		
			for (int j=0;j<19;j++){
				data[outermost][i][j]=(Integer.parseInt(s1[j]))/reducto;
			}
		}
		s=reader.readLine();
		Toptopics[outermost]=s.split(",");
	}//Outermost
	
	laidOut=false;
	choice.removeAll();
	ch2.removeAll();
    for (int i=0; i<tables; i++)  {choice.addItem(date[i]);
    ch2.addItem(date[i]);
    }
    add(choice);
    add(ch2);
    ch2.select(10);
    choice.select(10);
    
}


@Override
public void mouseClicked(MouseEvent e) {
	int x,y;
	x=e.getX();
	y=e.getY();
	if (x<720 && x>150 && y<670 && y>100){
		highlight_j=(x-150)/30;
		highlight_i=(y-100)/30;
		show=1;
		repaint();
	}
	
}

@Override
public void mousePressed(MouseEvent e) {
	
}

@Override
public void mouseReleased(MouseEvent e) {
	// TODO Auto-generated method stub
	
}

@Override
public void mouseEntered(MouseEvent e) {
	// TODO Auto-generated method stub
	
}

@Override
public void mouseExited(MouseEvent e) {
	// TODO Auto-generated method stub
	
}

@Override
public void actionPerformed(ActionEvent e) {
	 Button source = (Button)e.getSource();
     if(source.getLabel() == "Play"){
    	which2= ch2.getSelectedIndex();
    	which= choice.getSelectedIndex();
    	if (which2>which) {
    		play=1;
    		repaint();
    	}
    	
     }
	
}



}