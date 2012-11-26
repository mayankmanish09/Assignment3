package Statistics;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.sql.Date;
import java.sql.Timestamp;

public class offline {
	// Global Variables...
	public static node nodes[] = new node[5000]; // The max node no. is 5000
	public static String locations[] = { "Asgard", "Agartha", "Avalon",
			"Cockaigne", "Camelot", "Hawaiki", "Meropis", "Mu", "Tartarus",
			"Niflheim", "Niflhel", "Utopia", "Valhalla", "Alfheim",
			"Hyperborea", "Heaven", "Hell", "Jotunheim", "Lemuria" };
	public static int no_loc = 19; // No of locations
	public static cluster Clusters[] = new cluster[19];
	int data[][];

	// Global variables end...

	public static void main(String args[]) throws IOException {

		FileReader f = null;
		f = new FileReader("log-graph.out"); // Linking f to file.
		BufferedReader reader = new BufferedReader(f); // Linking a buffer to f.

		String s = reader.readLine();
		String s1[] = s.split(" ");
		String nodecomma[];
		while (s1[1].equals("node")) {

			nodecomma = s1[2].split(",");
			int node = Integer.parseInt(nodecomma[0]);

			nodes[node] = new node(100);
			nodes[node].location = s1[3];
			s = reader.readLine();
			s1 = s.split(" ");
		}

		// Reading Edges...
		String s2[];
		int e1, e2;
		while (s != null) {
			s1 = s.split(" ");
			s2 = s1[2].split("-");
			e1 = Integer.parseInt(s2[0]);
			e2 = Integer.parseInt(s2[1]);

			if (nodes[e1] != null && nodes[e2] != null) { // some nodes do not
															// exist but they
															// have links!!!
				// What about redundancies????
				nodes[e1].edges[nodes[e1].no_edges++] = e2;
				nodes[e2].edges[nodes[e2].no_edges++] = e1;
			}
			s = reader.readLine();
		}// Edge reading complete...
		f.close();
		reader.close();// Done file reading
		// ----------------------------------

		// Now we have made nodes...with edges...we need to make clusters.
		for (int i = 0; i < 19; i++) {
			Clusters[i] = new cluster(300, 20000);
			Clusters[i].name = locations[i];
		}
		// Filling in cluster information...
		for (int i = 0; i < 5000; i++) {
			node temp = nodes[i];
			if (temp != null) {
				int index = tell_loc(temp.location);
				Clusters[index].size++; // Ovious
				Clusters[index].nodes[Clusters[index].no_nodes++] = i;
				for (int j = 0; j < temp.no_edges; j++) {
					Clusters[index].edges[Clusters[index].no_edges++] = temp.edges[j];
					Clusters[index].size_cluster_edge[tell_loc(nodes[temp.edges[j]].location)]++;
				}
			}
		}
		// Cluster information filled...
		// Need to compress information...
		for (int i = 0; i < 19; i++)
			Clusters[i].compress();

		// ------------------------------------------------
		// print_friends(); //To print information about friendship trends of
		// locations...
		// print_size_locations();
		// print_friends_mashup();
//finding out friends of friends......
		FileWriter fw = new FileWriter("comm.csv");
		BufferedWriter b = new BufferedWriter(fw);

// --------------------------------------------------------------------------------------
// Lets now start reading the files...and start making new csv files...
		

		boolean go_on = true; 				// Change here to stop comm. load
		int file_no = 0;
		f = new FileReader(givefilename(file_no++));
		reader = new BufferedReader(f);
		
		s = reader.readLine();
		s1 = s.split(" ");
		String s3[] = s1[7].split("-");
		String s4[] = s3[1].split(",");
		int temp = Integer.parseInt(s1[3]);
		int dates = 0;
		while (go_on) {
// ------------------------------------------------Analyze all communication history here----------------------------------------------------
			s1 = s.split(" ");
			s3 = s1[7].split("-");
			s4 = s3[1].split(",");

			int date = Integer.parseInt(s1[3]);		
			int node1 = Integer.parseInt(s3[0]);
			int node2 = Integer.parseInt(s4[0]);
			String present_month = s1[2];

			//System.out.println(s1[8]);
			String topic=new String(s1[8]);
			//feeding into node 1
		if (nodes[node1] != null){
			int flag=0;
			for (int i=0; i<nodes[node1].no_topics;i++){
				if (topic.equals(nodes[node1].topics[i])){
					flag=1;
					nodes[node1].topic_freq[i]++;
					i=10000;
				}
				
				if (flag==0){
					nodes[node1].topics[nodes[node1].no_topics]=new String(topic);
					nodes[node1].no_topics++;
				}	
			}
		}
		if (nodes[node2] != null){
			int flag=0;
			for (int i=0; i<nodes[node2].no_topics;i++){
				if (topic.equals(nodes[node2].topics[i])){
					flag=1;
					nodes[node2].topic_freq[i]++;
					i=10000;
				}
				
				if (flag==0){
					nodes[node2].topics[nodes[node2].no_topics]=new String(topic);
					nodes[node2].no_topics++;
				}	
			}
		}
		
		
//-------------------------------Done with all--------------------------------------------		
			s = reader.readLine();
			if (s == null) {
				try {
					f = new FileReader(givefilename(file_no++));
				} catch (FileNotFoundException e) {
				}
				if (f == null) {
					go_on = false;
				} else {
					reader = new BufferedReader(f);
					s = reader.readLine();
				}
			}
			if (s == null)
				go_on = false;

		}
// ---------------------------------------------------------------------------------------------------------------

/*
//This part prints the table for location-mao vizualization
		b.write("Source, Destinstion,");
		for (int i = 0; i < 9; i++) {
			b.write(months[i] + ",");
		}
		b.write("\n");
		for (int i = 0; i < 19; i++) {
			for (int j = i + 1; j < 19; j++) {
				b.write(locations[i] + "," + locations[j] + ",");
				for (int k = 0; k < 9; k++) {
					b.write(data[i][j][k] + ",");
				}
				b.write('\n');
			}
		}
*/
		
		for (int i=0;i<5000;i++){
			if (nodes[i] != null){
				//nodes[i].topicsort();
			}
		}
		
		
		
		//Now analyzing for friend suggestion...
		
		for (int i=0;i<5000;i++){
			if (nodes[i] != null){
				int suggest=0,freq=0;
				int suggest_strength=0;
				String taste=new String();
				
				for (int k=0; k<nodes[i].no_topics; k++){
					if (nodes[i].freq[k] > freq){
						freq=nodes[i].freq[k];
						taste = new String(nodes[i].topics[k]);
						}
				}
				
				for (int j=0;j<5000;j++){
					if (nodes[j] !=null){
					String t1=new String();
					String t2=new String();
					//Finding out best topics of i and j resp
					int freq2=0;
					for (int k=0; k<nodes[j].no_topics; k++){
						if (nodes[j].freq[k] > freq2){
							freq2=nodes[j].freq[k];
							t1 = new String(nodes[j].topics[k]);
							}
					}
					//nodes[j].freq[freq2]=0;
					
					int freq22=0;
					
					for (int k=0; k<nodes[j].no_topics; k++){
						if (nodes[j].freq[k] > freq2){
							freq2=nodes[j].freq[k];
							t1 = new String(nodes[j].topics[k]);
							}
					}
					
					
					if (taste.equals(t1)) {
						//System.out.println("Node "+ i+ " Has a taste match with "+ j);
						if (suggest_strength>freq2){
							suggest=j;
							suggest_strength=freq2;
						}
					}
					
				
					}
				}
				b.write(i+","+suggest+","+suggest_strength+"\n");
			}
		}
		
	
		
		
		b.close();
		System.out.println("Ho gya");
	} // End of main...

	public static int tell_loc(String location) {
		for (int i = 0; i < no_loc; i++) {
			if (locations[i].equals(location))
				return i;
		}
		return 0;
	}// End of tell_loc

	public static int tell_cluster(int node_no) {

		return tell_loc(nodes[node_no].location);
	}

	public static void print_friends() {

		for (int i = 0; i < 19; i++) {
			float percentage = (float) Clusters[i].no_nodes * 100
					/ (Clusters[i].no_edges - Clusters[i].no_nodes);
			System.out.print("Inside " + locations[i] + " : "
					+ Clusters[i].no_nodes);
			System.out.print("\tOutside : "
					+ (Clusters[i].no_edges - Clusters[i].no_nodes));
			System.out.println("\t\tPercentage : " + percentage);
		}
	}

	public static void print_size_locations() {
		int sizes[] = new int[19];

		for (int i = 0; i < 5000; i++) {
			node temp = nodes[i];
			if (temp != null) {
				int index = tell_loc(temp.location);
				sizes[index]++;
			}
		}

		for (int i = 0; i < 19; i++) {

			System.out.println("No.of people in " + locations[i] + " = "
					+ sizes[i]);
		}

	}

	public static void print_friends_mashup() {
		for (int i = 0; i < 19; i++) {
			System.out.print(Clusters[i].name + " ,");
			for (int j = 0; j < 19; j++)
				System.out.print(Clusters[i].size_cluster_edge[j] + " ,");
			System.out.println();
		}
	}

	public static String givefilename(int i) {
		if (i < 10)
			return ("log-comm.0" + Integer.toString(i) + ".out");
		return ("log-comm." + Integer.toString(i) + ".out");

	}
}
