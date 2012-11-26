package Statistics;

public class cluster {
	public String name;			//Name of the cluster...
	public int size;			//Size of the cluster...generally equal to no. of nodes.
	public int nodes[], no_nodes;			//Node nos...which constitute the cluster
	public int edges[], no_edges;			//Edges to nodes...Many many repetitions...
	
	public int size_cluster_edge[];			//Weight of edge to other cluster...Edges to other clusters
	
	public cluster(int n1, int e1){
		nodes=new int[n1];
		edges=new int[e1];
		size_cluster_edge=new int[19];
		
		no_nodes=0; no_edges=0; size =0;
	}
	
	/**
	*Used for finding friend suggestions
	*/
	public void compress(){
		int arr[]=new int[2500]; 	//(Very safe!!!)
		int arr_size=0;
		
		for (int i=0 ;i< no_edges; i++){
			int temp=edges[i];
			int flag=0;
			for (int j=0; j<arr_size;j++){
				if (arr[j]==temp)	{ flag =1; j=arr_size;}
			}
			
			if (flag==0) arr[arr_size++]=temp;
				
		}//i loop
		
		edges=arr;
		no_edges=arr_size;
		//System.out.println("pppppppppppp"+no_edges);
	}
	
}
