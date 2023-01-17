class Solution {
public:
    int findMiddleIndex(vector<int>& nums) {
        int size=nums.size();
        int leftSum=0;
       // int rightSum=0;
        int prefix_sum=0;
        for(int i=0;i<size;i++){
            prefix_sum+=nums[i];
        }
        int rightSum=prefix_sum;
        for(int i=0;i<size;i++){
            rightSum=rightSum-nums[i];
            if(rightSum==leftSum)
                return i;
            leftSum+=nums[i];
            
        }
        return -1;
    }
};