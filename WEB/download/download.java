package a3;

import java.io.*;
import java.net.*;

public class download {
        public static void main(String[] args) throws IOException {
        	
        	BufferedReader br = new BufferedReader(new FileReader("pointer.txt"));
        	int s = Integer.parseInt(br.readLine());
        	System.out.println(s);
                URL url; //represents the location of the file we want to dl.
                URLConnection con;  // represents a connection to the url we want to dl.
                DataInputStream dis;  // input stream that will read data from the file.
                FileOutputStream fos; //used to write data from inut stream to file.
                byte[] fileData;  //byte aray used to hold data from downloaded file.
                try {
                	String str;
                	if(s < 10){
                		str = "log-comm.0"+s+".out";
                	}else{
                		str = "log-comm."+s+".out";
                	}
                        url = new URL("http://www.cse.iitd.ernet.in/act4d/csp301/"+str);
                        Proxy proxy = new Proxy(Proxy.Type.HTTP, new InetSocketAddress("proxy22.iitd.ernet.in",3128));
                        con = url.openConnection(proxy);
                        dis = new DataInputStream(con.getInputStream()); // get a data stream from the url connection.
                        fileData = new byte[con.getContentLength()]; // determine how many byes the file size is and make array big enough to hold the data
                        for (int x = 0; x < fileData.length; x++) { // fill byte array with bytes from the data input stream
                                fileData[x] = dis.readByte();
                        }
                        dis.close(); // close the data input stream
                        fos = new FileOutputStream(new File(str));  //create an object representing the file we want to save
                        fos.write(fileData);  // write out the file we want to save.
                        fos.close(); // close the output stream writer
                }
                catch(MalformedURLException m) {
                        System.out.println(m);
                        s--;
                }
                catch(IOException io) {
                        System.out.println(io);
                        s--;
                }
        
                /*FileWriter fstream = new FileWriter("pointer.txt");
  			    BufferedWriter out = new BufferedWriter(fstream);
  			    s++;
  			    String s1 = ""+s;
  			    out.write(s1);
  			    out.close();*/
        }
}